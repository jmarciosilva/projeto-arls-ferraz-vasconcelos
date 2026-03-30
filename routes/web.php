<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use Illuminate\Support\Facades\Route;

// --- ROTAS PUBLICAS ---
Route::get('/', [MainController::class, 'index']);
Route::get('/maconaria', [MainController::class, 'maconaria']);
Route::get('/noticias', [MainController::class, 'noticias']);
Route::get('/noticias/{slug}', [MainController::class, 'noticiaDetalhe']);
Route::get('/galeria', [MainController::class, 'galeria']);
Route::get('/jantar', [MainController::class, 'jantar']);
Route::get('/maconaria-jovens', [MainController::class, 'maconariaJovens']);
Route::get('/mudar-cidadao', [MainController::class, 'mudarCidadao']);
Route::get('/sobre-nos', [MainController::class, 'sobreNos']);
Route::get('/sete-setembro-2024', [MainController::class, 'seteSetembro']);

// --- AUTENTICACAO ADMIN ---
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// --- PAINEL ADMIN (protegido por is_admin) ---
Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('noticias', NoticiaController::class)->except(['show']);
    Route::resource('galeria', GaleriaController::class)->except(['show']);
    Route::post('galeria/{galeria}/fotos', [GaleriaController::class, 'uploadFotos'])
        ->name('admin.galeria.fotos');
    Route::delete('galeria/fotos/{foto}', [GaleriaController::class, 'destroyFoto'])
        ->name('admin.galeria.fotos.destroy');
    Route::resource('slides', SlideController::class)->except(['show']);
    Route::get('configuracoes', [ConfiguracaoController::class, 'edit'])
        ->name('admin.configuracoes');
    Route::post('configuracoes', [ConfiguracaoController::class, 'save'])
        ->name('admin.configuracoes.save');
});
