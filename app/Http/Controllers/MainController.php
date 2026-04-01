<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Galeria;
use App\Models\Noticia;
use App\Models\Sessao;
use App\Models\Slide;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('landing.home', [

            // Slides (já existente)
            'slides' => Slide::where('ativo', true)->orderBy('ordem')->get(),

            // Destaques (portal)
            'destaques' => Noticia::where('publicado', true)
                ->where('destaque', true)
                ->latest()
                ->take(3)
                ->get(),

            // Últimas notícias
            'noticias' => Noticia::where('publicado', true)
                ->latest('publicado_em')
                ->take(6)
                ->get(),

            // Mais lidas
            'maisLidas' => Noticia::where('publicado', true)
                ->orderByDesc('views')
                ->take(5)
                ->get(),

            // Próximas sessões para exibir na home
            'sessoes' => Sessao::where('publicado', true)
                ->where('data', '>=', today())
                ->orderBy('data')
                ->take(6)
                ->get(),

            // Próximos eventos publicados, destaques primeiro
            'eventos' => Evento::where('publicado', true)
                ->where('data_inicio', '>=', today())
                ->orderByDesc('destaque')
                ->orderBy('data_inicio')
                ->take(6)
                ->get(),
        ]);
    }

    /**
     * ============================================================
     * LISTAGEM DE NOTÍCIAS (PORTAL)
     * ============================================================
     */
    public function noticias()
    {
        // Notícia principal (mais recente)
        $destaque = Noticia::where('publicado', true)
            ->latest()
            ->first();

        // Outras notícias
        $noticias = Noticia::where('publicado', true)
            ->when($destaque, fn($q) => $q->where('id', '!=', $destaque->id))
            ->latest()
            ->paginate(6);

        // Sidebar (últimas)
        $ultimas = Noticia::where('publicado', true)
            ->latest()
            ->take(5)
            ->get();

        return view('landing.noticias', compact('destaque', 'noticias', 'ultimas'));
    }

    public function noticiaDetalhe($slug)
    {
        $noticia = Noticia::where('slug', $slug)
            ->where('publicado', true)
            ->firstOrFail();

        return view('landing.noticia-detalhe', compact('noticia'));
    }

    // Adicionar método eventoDetalhe()
    public function eventoDetalhe(string $slug)
    {
        // Busca o evento pelo slug — retorna 404 se não encontrado ou não publicado
        $evento = \App\Models\Evento::where('slug', $slug)
            ->where('publicado', true)
            ->firstOrFail();

        // Outros eventos futuros para a sidebar (exclui o atual)
        $outrosEventos = \App\Models\Evento::where('publicado', true)
            ->where('id', '!=', $evento->id)
            ->where('data_inicio', '>=', today())
            ->orderBy('data_inicio')
            ->take(4)
            ->get();

        return view('landing.evento-detalhe', compact('evento', 'outrosEventos'));
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
