<?php

use Illuminate\Support\Facades\Route;

// Controllers públicos
use App\Http\Controllers\MainController;

// Controllers administrativos
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use App\Http\Controllers\Admin\MembroController;
use App\Http\Controllers\Admin\SessaoController;
use App\Http\Controllers\Admin\EventoController;

/**
 * ============================================================
 * ROTAS PÚBLICAS (SITE / LANDING PAGE)
 * ============================================================
 */

// Página inicial
Route::get('/', [MainController::class, 'index'])->name('home');

// Conteúdo institucional
Route::get('/maconaria', [MainController::class, 'maconaria'])->name('maconaria');
Route::get('/maconaria-jovens', [MainController::class, 'maconariaJovens'])->name('maconaria.jovens');
Route::get('/mudar-cidadao', [MainController::class, 'mudarCidadao'])->name('mudar.cidadao');
Route::get('/sobre-nos', [MainController::class, 'sobreNos'])->name('sobre.nos');

// Eventos e páginas específicas
Route::get('/jantar', [MainController::class, 'jantar'])->name('jantar');
Route::get('/sete-setembro-2024', [MainController::class, 'seteSetembro'])->name('sete.setembro');

// Galeria pública
Route::get('/galeria', [MainController::class, 'galeria'])->name('galeria');

// Notícias (portal)
Route::get('/noticias', [MainController::class, 'noticias'])->name('noticias');
Route::get('/noticias/{slug}', [MainController::class, 'noticiaDetalhe'])->name('noticias.detalhe');

// Detalhe público de um evento
Route::get('/eventos/{slug}', [MainController::class, 'eventoDetalhe'])->name('eventos.detalhe');



/**
 * ============================================================
 * AUTENTICAÇÃO ADMIN
 * ============================================================
 */

// Tela de login
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');

// Processar login
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Logout
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


/**
 * ============================================================
 * PAINEL ADMINISTRATIVO
 * ============================================================
 * Todas as rotas abaixo estão protegidas pelo middleware is_admin
 */
Route::prefix('admin')->middleware('is_admin')->group(function () {

    /**
     * ------------------------------------------------------------
     * DASHBOARD
     * ------------------------------------------------------------
     */
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');


    /**
     * ============================================================
     * CRUD DE NOTÍCIAS
     * ============================================================
     */

    // Listar notícias
    Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');

    // Formulário de criação
    Route::get('/noticias/create', [NoticiaController::class, 'create'])->name('noticias.create');

    // Salvar nova notícia
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');

    // Formulário de edição
    Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');

    // Atualizar notícia
    Route::put('/noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');

    // Excluir notícia
    Route::delete('/noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');

    Route::post('/upload-imagem', [\App\Http\Controllers\Admin\NoticiaController::class, 'uploadImagem']);


    /**
     * ============================================================
     * CRUD DE CATEGORIAS
     * ============================================================
     */

    // Listar categorias
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    // Formulário de criação
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');

    // Salvar categoria
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');

    // Formulário de edição
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');

    // Atualizar categoria
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');

    // Excluir categoria
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');


    /**
     * ============================================================
     * CRUD DE GALERIA
     * ============================================================
     */

    Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
    Route::get('/galeria/create', [GaleriaController::class, 'create'])->name('galeria.create');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
    Route::get('/galeria/{galeria}/edit', [GaleriaController::class, 'edit'])->name('galeria.edit');
    Route::put('/galeria/{galeria}', [GaleriaController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{galeria}', [GaleriaController::class, 'destroy'])->name('galeria.destroy');

    // Upload de fotos
    Route::post('/galeria/{galeria}/fotos', [GaleriaController::class, 'uploadFotos'])
        ->name('galeria.fotos');

    // Remover foto
    Route::delete('/galeria/fotos/{foto}', [GaleriaController::class, 'destroyFoto'])
        ->name('galeria.fotos.destroy');


    /**
     * ============================================================
     * CRUD DE SLIDES
     * ============================================================
     */

    Route::get('/slides', [SlideController::class, 'index'])->name('slides.index');
    Route::get('/slides/create', [SlideController::class, 'create'])->name('slides.create');
    Route::post('/slides', [SlideController::class, 'store'])->name('slides.store');
    Route::get('/slides/{slide}/edit', [SlideController::class, 'edit'])->name('slides.edit');
    Route::put('/slides/{slide}', [SlideController::class, 'update'])->name('slides.update');
    Route::delete('/slides/{slide}', [SlideController::class, 'destroy'])->name('slides.destroy');


    /**
     * ============================================================
     * CONFIGURAÇÕES DO SISTEMA
     * ============================================================
     */

    Route::get('/configuracoes', [ConfiguracaoController::class, 'edit'])
        ->name('configuracoes.edit');

    Route::post('/configuracoes', [ConfiguracaoController::class, 'save'])
        ->name('configuracoes.save');


    /**
     * ============================================================
     * CRUD DE MEMBROS
     * ============================================================
     */

    Route::get('/membros', [MembroController::class, 'index'])->name('membros.index');
    Route::get('/membros/create', [MembroController::class, 'create'])->name('membros.create');
    Route::post('/membros', [MembroController::class, 'store'])->name('membros.store');
    Route::get('/membros/{membro}', [MembroController::class, 'show'])->name('membros.show');
    Route::get('/membros/{membro}/edit', [MembroController::class, 'edit'])->name('membros.edit');
    Route::put('/membros/{membro}', [MembroController::class, 'update'])->name('membros.update');
    Route::delete('/membros/{membro}', [MembroController::class, 'destroy'])->name('membros.destroy');


    /**
     * ------------------------------------------------------------
     * FAMILIARES DO MEMBRO
     * ------------------------------------------------------------
     */

    Route::post('/membros/{membro}/familiares', [MembroController::class, 'storeFamiliar'])
        ->name('membros.familiares.store');

    Route::delete('/membros/familiares/{familiar}', [MembroController::class, 'destroyFamiliar'])
        ->name('membros.familiares.destroy');


    /**
     * ------------------------------------------------------------
     * HISTÓRICO DE CARGOS
     * ------------------------------------------------------------
     */

    Route::post('/membros/{membro}/cargos', [MembroController::class, 'storeCargo'])
        ->name('membros.cargos.store');

    Route::delete('/membros/cargos/{cargo}', [MembroController::class, 'destroyCargo'])
        ->name('membros.cargos.destroy');


    /**
     * ============================================================
     * CRUD DE SESSÕES DO CALENDÁRIO DA LOJA
     * ============================================================
     */
    Route::get('/sessoes', [SessaoController::class, 'index'])->name('sessoes.index');
    Route::get('/sessoes/create', [SessaoController::class, 'create'])->name('sessoes.create');
    Route::post('/sessoes', [SessaoController::class, 'store'])->name('sessoes.store');
    Route::get('/sessoes/{sessao}/edit', [SessaoController::class, 'edit'])->name('sessoes.edit');
    Route::put('/sessoes/{sessao}', [SessaoController::class, 'update'])->name('sessoes.update');
    Route::delete('/sessoes/{sessao}', [SessaoController::class, 'destroy'])->name('sessoes.destroy');

    /**
     * ============================================================
     * CRUD DE EVENTOS DA LOJA
     * ============================================================
     */
    Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
});
