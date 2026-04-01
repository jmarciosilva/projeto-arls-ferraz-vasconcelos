{{--
    ============================================================
    View: admin/dashboard.blade.php
    Descrição: Painel inicial do administrador
    Exibe contadores, últimas notícias e atalhos de acesso rápido
    ============================================================
--}}
@extends('admin.layouts.app')

@section('content')
    {{-- ── Cabeçalho de boas-vindas ── --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h3 class="mb-1 fw-bold" style="color: #1a3a5c">
                <i class="bi bi-pentagon-fill me-2" style="color:#c9a84c"></i>
                Painel da Loja
            </h3>
            <p class="text-muted mb-0" style="font-size:1.05rem">
                Bem-vindo, <strong>{{ Auth::user()->name }}</strong> —
                {{ now()->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            </p>
        </div>
        {{-- Botão de acesso rápido ao site público --}}
        <a href="/" target="_blank" class="btn btn-outline-secondary">
            <i class="bi bi-globe me-2"></i>Ver Site Público
        </a>
    </div>

    {{-- ════════════════════════════════════════════════════════
     CARDS DE CONTAGEM
     Cards grandes e coloridos para fácil leitura
     ════════════════════════════════════════════════════════ --}}
    <div class="row g-3 mb-4">

        {{-- Card: Notícias --}}
        <div class="col-sm-6 col-xl-3">
            <a href="/admin/noticias" class="text-decoration-none">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1e6fa8, #2c5f8a);">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;background:rgba(255,255,255,.2);flex-shrink:0">
                            <i class="bi bi-newspaper text-white" style="font-size:1.6rem"></i>
                        </div>
                        <div class="text-white">
                            <div style="font-size:2.2rem;font-weight:800;line-height:1">{{ $totalNoticias }}</div>
                            <div style="font-size:1rem;opacity:.9">Notícias</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card: Galeria --}}
        <div class="col-sm-6 col-xl-3">
            <a href="/admin/galeria" class="text-decoration-none">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #1a7a4a, #2e7d32);">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;background:rgba(255,255,255,.2);flex-shrink:0">
                            <i class="bi bi-images text-white" style="font-size:1.6rem"></i>
                        </div>
                        <div class="text-white">
                            <div style="font-size:2.2rem;font-weight:800;line-height:1">{{ $totalGalerias }}</div>
                            <div style="font-size:1rem;opacity:.9">Álbuns de Fotos</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card: Slides --}}
        <div class="col-sm-6 col-xl-3">
            <a href="/admin/slides" class="text-decoration-none">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #b85c00, #e65100);">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;background:rgba(255,255,255,.2);flex-shrink:0">
                            <i class="bi bi-collection-play text-white" style="font-size:1.6rem"></i>
                        </div>
                        <div class="text-white">
                            <div style="font-size:2.2rem;font-weight:800;line-height:1">{{ $totalSlides }}</div>
                            <div style="font-size:1rem;opacity:.9">Slides do Banner</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card: Membros --}}
        <div class="col-sm-6 col-xl-3">
            <a href="/admin/membros" class="text-decoration-none">
                <div class="card border-0 h-100" style="background: linear-gradient(135deg, #6a1a8a, #7b1fa2);">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width:60px;height:60px;background:rgba(255,255,255,.2);flex-shrink:0">
                            <i class="bi bi-people text-white" style="font-size:1.6rem"></i>
                        </div>
                        <div class="text-white">
                            {{-- Busca o total de membros ativos --}}
                            <div style="font-size:2.2rem;font-weight:800;line-height:1">
                                {{ \App\Models\Membro::where('situacao', 'ativo')->count() }}
                            </div>
                            <div style="font-size:1rem;opacity:.9">Irmãos Ativos</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    {{-- ════════════════════════════════════════════════════════
     ACESSO RÁPIDO
     Botões grandes e coloridos para as ações mais usadas
     ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 mb-4">
        <div class="card-header bg-white">
            <i class="bi bi-lightning-fill me-2" style="color:#c9a84c"></i>
            <strong>Acesso Rápido</strong>
            <small class="text-muted ms-2">Ações mais utilizadas</small>
        </div>
        <div class="card-body p-3">
            <div class="row g-2">

                {{-- Cadastrar novo irmão --}}
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/admin/membros/create"
                        class="btn w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 py-3"
                        style="background:#7b1fa2;color:#fff;border:none;min-height:90px">
                        <i class="bi bi-person-plus-fill" style="font-size:1.8rem"></i>
                        <span style="font-size:.88rem;line-height:1.2;text-align:center">Cadastrar<br>Irmão</span>
                    </a>
                </div>

                {{-- Nova notícia --}}
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/admin/noticias/create"
                        class="btn w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 py-3"
                        style="background:#1e6fa8;color:#fff;border:none;min-height:90px">
                        <i class="bi bi-pencil-square" style="font-size:1.8rem"></i>
                        <span style="font-size:.88rem;line-height:1.2;text-align:center">Nova<br>Notícia</span>
                    </a>
                </div>

                {{-- Novo álbum de fotos --}}
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/admin/galeria/create"
                        class="btn w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 py-3"
                        style="background:#1a7a4a;color:#fff;border:none;min-height:90px">
                        <i class="bi bi-folder-plus" style="font-size:1.8rem"></i>
                        <span style="font-size:.88rem;line-height:1.2;text-align:center">Novo Álbum<br>de Fotos</span>
                    </a>
                </div>

                {{-- Novo slide --}}
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/admin/slides/create"
                        class="btn w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 py-3"
                        style="background:#b85c00;color:#fff;border:none;min-height:90px">
                        <i class="bi bi-image" style="font-size:1.8rem"></i>
                        <span style="font-size:.88rem;line-height:1.2;text-align:center">Novo<br>Slide</span>
                    </a>
                </div>

                {{-- Ver todos os membros --}}
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/admin/membros"
                        class="btn w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 py-3"
                        style="background:#1a3a5c;color:#fff;border:none;min-height:90px">
                        <i class="bi bi-people-fill" style="font-size:1.8rem"></i>
                        <span style="font-size:.88rem;line-height:1.2;text-align:center">Ver<br>Membros</span>
                    </a>
                </div>

                {{-- Configurações --}}
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/admin/configuracoes"
                        class="btn w-100 h-100 d-flex flex-column align-items-center justify-content-center gap-2 py-3"
                        style="background:#546e7a;color:#fff;border:none;min-height:90px">
                        <i class="bi bi-gear-fill" style="font-size:1.8rem"></i>
                        <span style="font-size:.88rem;line-height:1.2;text-align:center">Configurações<br>da Loja</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
     ÚLTIMAS NOTÍCIAS
     ════════════════════════════════════════════════════════ --}}
    <div class="card border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-newspaper me-2" style="color:#1e6fa8"></i>
                <strong>Últimas Notícias Cadastradas</strong>
            </div>
            <a href="/admin/noticias/create" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Nova Notícia
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Título da Notícia</th>
                            <th>Situação</th>
                            <th>Data</th>
                            <th class="text-end">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasNoticias as $noticia)
                            <tr>
                                <td>
                                    <span class="fw-semibold">
                                        {{ Str::limit($noticia->titulo, 50) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($noticia->publicado)
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>Publicada
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-pencil me-1"></i>Rascunho
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    {{ $noticia->created_at->format('d/m/Y') }}
                                </td>
                                <td class="text-end">
                                    <a href="/admin/noticias/{{ $noticia->id }}/edit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil me-1"></i>Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-newspaper d-block mb-2" style="font-size:2rem;opacity:.3"></i>
                                    Nenhuma notícia cadastrada ainda.
                                    <br>
                                    <a href="/admin/noticias/create" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-lg me-1"></i>Cadastrar primeira notícia
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($ultimasNoticias->count() > 0)
            <div class="card-footer bg-white text-end">
                <a href="/admin/noticias" class="btn btn-outline-primary btn-sm">
                    Ver todas as notícias <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        @endif
    </div>
@endsection
