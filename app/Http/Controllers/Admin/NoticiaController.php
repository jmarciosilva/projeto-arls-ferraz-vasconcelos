<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\Categoria;

class NoticiaController extends Controller
{
    /**
     * ============================================================
     * LISTAGEM DE NOTÍCIAS
     * ============================================================
     * Exibe todas as notícias cadastradas com paginação
     */
    public function index(Request $request)
    {
        $query = Noticia::query();

        // Filtro por busca (título)
        if ($request->filled('busca')) {
            $query->where('titulo', 'like', '%' . $request->busca . '%');
        }

        // Filtro por status (publicado ou rascunho)
        if ($request->filled('status')) {
            $query->where('publicado', $request->status);
        }

        return view('admin.noticias.index', [
            'noticias' => $query->latest()->paginate(15)
        ]);
    }

    /**
     * ============================================================
     * FORMULÁRIO DE CRIAÇÃO
     * ============================================================
     */
    public function create()
    {
        return view('admin.noticias.form', [
            'categorias' => Categoria::orderBy('nome')->get()
        ]);
    }

    /**
     * ============================================================
     * SALVAR NOVA NOTÍCIA
     * ============================================================
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validação dos dados
            $data = $request->validate([
                'titulo'    => 'required|string|max:255',
                'resumo'    => 'nullable|string|max:500',
                'conteudo'  => 'required|string',
                'categoria_id' => 'nullable|exists:categorias,id',
                'foto_capa' => 'nullable|image|max:4096',
            ]);

            // Upload da imagem (se houver)
            if ($request->hasFile('foto_capa')) {
                $data['foto_capa'] = $request->file('foto_capa')
                    ->store('noticias', 'public');
            }

            // Gera slug único
            $data['slug'] = $this->gerarSlugUnico($data['titulo']);

            // Usuário logado
            $data['user_id'] = Auth::id();

            // Status de publicação
            $data['publicado'] = $request->has('publicado');
            $data['publicado_em'] = $data['publicado'] ? now() : null;

            // Cria a notícia
            Noticia::create($data);

            DB::commit();

            // Limpa cache (caso utilize no front)
            Cache::forget('noticias_publicadas');

            return redirect()->route('noticias.index')
                ->with('success', 'Notícia cadastrada com sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Erro ao criar notícia', [
                'erro' => $e->getMessage()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Erro ao salvar a notícia. Tente novamente.');
        }
    }

    /**
     * ============================================================
     * FORMULÁRIO DE EDIÇÃO
     * ============================================================
     */
    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.form', [
            'noticia' => $noticia,
            'categorias' => Categoria::orderBy('nome')->get()
        ]);
    }

    /**
     * ============================================================
     * ATUALIZAR NOTÍCIA
     * ============================================================
     */
    public function update(Request $request, Noticia $noticia)
    {
        try {
            DB::beginTransaction();

            // Validação
            $data = $request->validate([
                'titulo'    => 'required|string|max:255',
                'resumo'    => 'nullable|string|max:500',
                'conteudo'  => 'required|string',
                'categoria_id' => 'nullable|exists:categorias,id',
                'foto_capa' => 'nullable|image|max:4096',
            ]);

            // Atualiza imagem se enviada
            if ($request->hasFile('foto_capa')) {

                // Remove imagem antiga
                if ($noticia->foto_capa) {
                    Storage::disk('public')->delete($noticia->foto_capa);
                }

                $data['foto_capa'] = $request->file('foto_capa')
                    ->store('noticias', 'public');
            }

            // Atualiza slug (caso título mude)
            $data['slug'] = $this->gerarSlugUnico($data['titulo']);

            // Atualiza status
            $data['publicado'] = $request->has('publicado');

            // Define data de publicação apenas se ainda não estava publicado
            if ($data['publicado'] && !$noticia->publicado) {
                $data['publicado_em'] = now();
            }

            // Atualiza no banco
            $noticia->update($data);

            DB::commit();

            Cache::forget('noticias_publicadas');

            return redirect()->route('noticias.index')
                ->with('success', 'Notícia atualizada com sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Erro ao atualizar notícia', [
                'erro' => $e->getMessage()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar a notícia.');
        }
    }

    /**
     * ============================================================
     * EXCLUIR NOTÍCIA
     * ============================================================
     */
    public function destroy(Noticia $noticia)
    {
        try {

            // Remove imagem do storage
            if ($noticia->foto_capa) {
                Storage::disk('public')->delete($noticia->foto_capa);
            }

            $noticia->delete();

            Cache::forget('noticias_publicadas');

            return back()->with('success', 'Notícia removida com sucesso!');
        } catch (\Exception $e) {

            Log::error('Erro ao excluir notícia', [
                'erro' => $e->getMessage()
            ]);

            return back()->with('error', 'Erro ao remover a notícia.');
        }
    }

    /**
     * ============================================================
     * GERA SLUG ÚNICO
     * ============================================================
     * Evita duplicidade de URLs
     */
    private function gerarSlugUnico($titulo)
    {
        $slug = Str::slug($titulo);
        $original = $slug;
        $contador = 1;

        while (Noticia::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $contador++;
        }

        return $slug;
    }

    /**
     * ============================================================
     * UPLOAD DE IMAGEM PARA O CKEDITOR
     * ============================================================
     */
    public function uploadImagem(Request $request)
    {
        if ($request->hasFile('upload')) {

            $file = $request->file('upload');

            // Gera nome único
            $nome = uniqid() . '.' . $file->getClientOriginalExtension();

            // Salva no storage
            $path = $file->storeAs('noticias', $nome, 'public');

            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json([
            'error' => [
                'message' => 'Upload falhou'
            ]
        ], 400);
    }
}
