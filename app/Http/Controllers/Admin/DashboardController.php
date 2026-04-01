<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\Noticia;
use App\Models\Slide;
use App\Models\Sessao;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalNoticias'   => Noticia::count(),
            'totalGalerias'   => Galeria::count(),
            'totalSlides'     => Slide::count(),
            'ultimasNoticias' => Noticia::latest()->take(5)->get(),
            // Próximas sessões para o dashboard
            'proximasSessoes' => Sessao::where('publicado', true)
                ->where('data', '>=', today())
                ->orderBy('data')
                ->take(3)
                ->get(),
        ]);
    }
}
