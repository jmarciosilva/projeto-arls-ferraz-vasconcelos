@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Dashboard</h4>
            <small class="text-muted">Bem-vindo, {{ Auth::user()->name }}</small>
        </div>
        <span class="text-muted small">{{ now()->format('d/m/Y') }}</span>
    </div>

    {{-- Cards de contagem --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#e8f0fe">
                        <i class="bi bi-newspaper fs-4" style="color:#2c5f8a"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold lh-1">{{ $totalNoticias }}</div>
                        <div class="text-muted small">Notícias</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#e6f4ea">
                        <i class="bi bi-images fs-4" style="color:#2e7d32"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold lh-1">{{ $totalGalerias }}</div>
                        <div class="text-muted small">Álbuns de Galeria</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#fff3e0">
                        <i class="bi bi-collection-play fs-4" style="color:#e65100"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold lh-1">{{ $totalSlides }}</div>
                        <div class="text-muted small">Slides do Banner</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3" style="background:#fce4ec">
                        <i class="bi bi-gear fs-4" style="color:#c62828"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold lh-1">
                            <i class="bi bi-check-circle-fill" style="color:#c62828; font-size:1.6rem"></i>
                        </div>
                        <div class="text-muted small">Configurações</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Últimas notícias + Acesso rápido --}}
    <div class="row g-3">

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Últimas Notícias</span>
                    <a href="/admin/noticias/create" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>Nova
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasNoticias as $noticia)
                                <tr>
                                    <td>{{ Str::limit($noticia->titulo, 45) }}</td>
                                    <td>
                                        @if ($noticia->publicado)
                                            <span class="badge bg-success">Publicada</span>
                                        @else
                                            <span class="badge bg-secondary">Rascunho</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">
                                        {{ $noticia->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <a href="/admin/noticias/{{ $noticia->id }}/edit"
                                            class="btn btn-sm btn-outline-primary">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Nenhuma notícia cadastrada ainda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($ultimasNoticias->count() > 0)
                    <div class="card-footer bg-white text-end">
                        <a href="/admin/noticias" class="small text-decoration-none">
                            Ver todas <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <span class="fw-semibold">Acesso Rápido</span>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <a href="/admin/noticias/create" class="btn btn-outline-primary text-start">
                        <i class="bi bi-plus-circle me-2"></i>Nova Notícia
                    </a>
                    <a href="/admin/galeria/create" class="btn btn-outline-success text-start">
                        <i class="bi bi-folder-plus me-2"></i>Novo Álbum de Fotos
                    </a>
                    <a href="/admin/slides/create" class="btn btn-outline-warning text-start">
                        <i class="bi bi-image me-2"></i>Novo Slide
                    </a>
                    <a href="/admin/configuracoes" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-gear me-2"></i>Configurações
                    </a>
                    <hr class="my-1">
                    <a href="/" target="_blank" class="btn btn-outline-dark text-start">
                        <i class="bi bi-box-arrow-up-right me-2"></i>Ver Site Público
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
