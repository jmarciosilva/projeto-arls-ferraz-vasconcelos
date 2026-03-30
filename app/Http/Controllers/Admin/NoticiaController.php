<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    public function index()
    {
        return view('admin.noticias.index', [
            'noticias' => Noticia::latest()->paginate(15)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'resumo'    => 'nullable|string|max:500',
            'conteudo'  => 'required|string',
            'foto_capa' => 'nullable|image|max:4096',
        ]);
        if ($request->hasFile('foto_capa')) {
            $data['foto_capa'] = $request->file('foto_capa')
                ->store('noticias', 'public');
        }
        $data['slug']        = Str::slug($data['titulo']);
        $data['user_id']     = Auth::id();
        $data['publicado']   = $request->has('publicado');
        $data['publicado_em'] = $data['publicado'] ? now() : null;
        Noticia::create($data);
        return redirect('/admin/noticias')->with('success', 'Noticia criada!');
    }

    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->validate([/* mesmo que store */]);
        if ($request->hasFile('foto_capa')) {
            if ($noticia->foto_capa)
                Storage::disk('public')->delete($noticia->foto_capa);
            $data['foto_capa'] = $request->file('foto_capa')
                ->store('noticias', 'public');
        }
        $data['publicado'] = $request->has('publicado');
        $noticia->update($data);
        return redirect('/admin/noticias')->with('success', 'Noticia atualizada!');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->foto_capa)
            Storage::disk('public')->delete($noticia->foto_capa);
        $noticia->delete();
        return back()->with('success', 'Noticia removida!');
    }
}
