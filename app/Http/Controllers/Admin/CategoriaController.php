<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * ============================================================
     * LISTAGEM DE CATEGORIAS
     * ============================================================
     */
    public function index()
    {
        return view('admin.categorias.index', [
            'categorias' => Categoria::latest()->paginate(10)
        ]);
    }

    /**
     * ============================================================
     * FORMULÁRIO DE CRIAÇÃO
     * ============================================================
     */
    public function create()
    {
        return view('admin.categorias.form');
    }

    /**
     * ============================================================
     * SALVAR NOVA CATEGORIA
     * ============================================================
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'nome' => 'required|string|max:255',
            ]);

            // Gera slug único
            $data['slug'] = $this->gerarSlugUnico($data['nome']);

            Categoria::create($data);

            DB::commit();

            return redirect()->route('categorias.index')
                ->with('success', 'Categoria criada com sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Erro ao criar categoria', [
                'erro' => $e->getMessage()
            ]);

            return back()->withInput()
                ->with('error', 'Erro ao salvar categoria.');
        }
    }

    /**
     * ============================================================
     * FORMULÁRIO DE EDIÇÃO
     * ============================================================
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.form', compact('categoria'));
    }

    /**
     * ============================================================
     * ATUALIZAR CATEGORIA
     * ============================================================
     */
    public function update(Request $request, Categoria $categoria)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'nome' => 'required|string|max:255',
            ]);

            $data['slug'] = $this->gerarSlugUnico($data['nome']);

            $categoria->update($data);

            DB::commit();

            return redirect()->route('categorias.index')
                ->with('success', 'Categoria atualizada!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Erro ao atualizar categoria', [
                'erro' => $e->getMessage()
            ]);

            return back()->withInput()
                ->with('error', 'Erro ao atualizar.');
        }
    }

    /**
     * ============================================================
     * EXCLUIR CATEGORIA
     * ============================================================
     */
    public function destroy(Categoria $categoria)
    {
        try {

            // Impede exclusão se houver notícias vinculadas
            if ($categoria->noticias()->count() > 0) {
                return back()->with('error', 'Não é possível excluir. Existem notícias vinculadas.');
            }

            $categoria->delete();

            return back()->with('success', 'Categoria removida.');
        } catch (\Exception $e) {

            Log::error('Erro ao excluir categoria', [
                'erro' => $e->getMessage()
            ]);

            return back()->with('error', 'Erro ao remover.');
        }
    }

    /**
     * ============================================================
     * GERA SLUG ÚNICO
     * ============================================================
     */
    private function gerarSlugUnico($nome)
    {
        $slug = Str::slug($nome);
        $original = $slug;
        $contador = 1;

        while (Categoria::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $contador++;
        }

        return $slug;
    }
}
