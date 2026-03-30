<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use App\Models\Noticia;
use App\Models\Slide;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('landing.home', [
            'slides'   => Slide::where('ativo', true)->orderBy('ordem')->get(),
            'noticias' => Noticia::where('publicado', true)
                ->latest('publicado_em')->take(3)->get(),
        ]);
    }

    public function noticias()
    {
        $noticias = Noticia::where('publicado', true)
            ->latest('publicado_em')->paginate(9);
        return view('landing.noticias', compact('noticias'));
    }

    public function noticiaDetalhe(string $slug)
    {
        $noticia = Noticia::where('slug', $slug)
            ->where('publicado', true)->firstOrFail();
        return view('landing.noticia_detalhe', compact('noticia'));
    }

    public function galeria()
    {
        $galerias = Galeria::where('publicado', true)->latest()->get();
        return view('landing.galeria', compact('galerias'));
    }

    public function maconaria()
    {
        return view('landing.maconaria');
    }

    public function jantar()
    {
        return view('landing.jantar_ritualistico');
    }

    public function maconariaJovens()
    {
        return view('landing.maconaria-jovens');
    }

    public function mudarCidadao()
    {
        return view('landing.mudar-cidadao');
    }

    public function sobreNos()
    {
        return view('landing.sobre-nos');
    }

    public function seteSetembro()
    {
        return view('landing.sete-setembro-2024');
    }
}
