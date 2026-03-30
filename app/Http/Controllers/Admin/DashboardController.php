<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\Noticia;
use App\Models\Slide;
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
        ]);
    }
}
