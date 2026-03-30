<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('ordem')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'imagem'    => 'nullable|image|max:4096',
            'link'      => 'nullable|url|max:255',
            'ordem'     => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')
                ->store('slides', 'public');
        }

        $data['ativo'] = $request->has('ativo');

        Slide::create($data);

        return redirect('/admin/slides')
            ->with('success', 'Slide criado com sucesso!');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.form', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'imagem'    => 'nullable|image|max:4096',
            'link'      => 'nullable|url|max:255',
            'ordem'     => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('imagem')) {
            if ($slide->imagem) {
                Storage::disk('public')->delete($slide->imagem);
            }
            $data['imagem'] = $request->file('imagem')
                ->store('slides', 'public');
        }

        $data['ativo'] = $request->has('ativo');

        $slide->update($data);

        return redirect('/admin/slides')
            ->with('success', 'Slide atualizado!');
    }

    public function destroy(Slide $slide)
    {
        if ($slide->imagem) {
            Storage::disk('public')->delete($slide->imagem);
        }

        $slide->delete();

        return back()->with('success', 'Slide removido!');
    }
}
