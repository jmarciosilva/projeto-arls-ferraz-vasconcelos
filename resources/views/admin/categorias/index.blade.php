@extends('admin.layouts.app')

@section('content')
    {{-- ── Cabeçalho com título, descrição e botão principal ── --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-tags-fill me-2" style="color:#c9a84c"></i>
                Categorias de Notícias
            </h3>
            <p class="text-muted mb-0">
                Organize as notícias do portal em categorias —
                <strong>{{ $categorias->total() }}</strong>
                {{ $categorias->total() === 1 ? 'categoria cadastrada' : 'categorias cadastradas' }}
            </p>
        </div>

        <div class="d-flex gap-2 align-items-center">

            {{-- Botão de ajuda --}}
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-ajuda"
                title="Como usar esta tela">
                <i class="bi bi-question-circle-fill me-1"></i>Ajuda
            </button>

            {{-- Botão principal --}}
            <a href="{{ route('categorias.create') }}" class="btn btn-lg" style="background:#7b1fa2;color:#fff;border:none">
                <i class="bi bi-plus-lg me-2"></i>Nova Categoria
            </a>

        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
 MODAL DE AJUDA
 ════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modal-ajuda" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <div class="modal-header" style="background:#1a3a5c">
                    <h5 class="modal-title text-white fw-bold">
                        <i class="bi bi-question-circle-fill me-2" style="color:#c9a84c"></i>
                        Como usar esta tela
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4" style="font-size:1.05rem">

                    <p class="mb-4">
                        Esta é a tela de <strong>gestão das categorias de notícias</strong>.
                        Aqui você organiza os assuntos que serão utilizados nas publicações do portal.
                    </p>

                    {{-- Funções --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-hand-index me-1"></i> O que cada botão faz:
                    </h6>

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#e8f0fe">
                                <span class="btn btn-primary btn-sm" style="pointer-events:none">
                                    <i class="bi bi-pencil-fill"></i>
                                </span>
                                <div>
                                    <strong>Editar</strong>
                                    <div class="text-muted small">
                                        Altera o nome da categoria
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#fce4ec">
                                <span class="btn btn-danger btn-sm" style="pointer-events:none">
                                    <i class="bi bi-trash-fill"></i>
                                </span>
                                <div>
                                    <strong>Excluir</strong>
                                    <div class="text-muted small">
                                        Remove a categoria (somente se não estiver em uso)
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Dica --}}
                    <div class="alert mb-0" style="background:#e8f5e9;border-left:4px solid #2e7d32">
                        <i class="bi bi-lightbulb-fill me-2" style="color:#2e7d32"></i>
                        <strong>Dica:</strong> Utilize poucas categorias e bem definidas.
                        Isso facilita a navegação dos visitantes no portal.
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">
                        <i class="bi bi-check-lg me-1"></i>Entendido, obrigado!
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
 TABELA DE CATEGORIAS
 ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm">

        <div class="table-responsive">
            <table class="table align-middle mb-0">

                <thead style="background:#1a3a5c">
                    <tr>
                        <th style="color:#fff;padding:1rem .75rem">Nome</th>
                        <th style="color:#fff;padding:1rem .75rem">Slug</th>
                        <th style="color:#c9a84c;text-align:center;padding:1rem .75rem">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categorias as $c)
                        <tr>

                            <td style="padding:.85rem .75rem">
                                <strong style="font-size:1.05rem;color:#1a3a5c">
                                    {{ $c->nome }}
                                </strong>
                            </td>

                            <td style="padding:.85rem .75rem">
                                <span class="text-muted">{{ $c->slug }}</span>
                            </td>

                            <td style="padding:.85rem .75rem;text-align:center">
                                <div class="d-flex justify-content-center gap-1">

                                    <a href="{{ route('categorias.edit', $c) }}" class="btn btn-primary btn-sm"
                                        title="Editar categoria">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <form method="POST" action="{{ route('categorias.destroy', $c) }}"
                                        onsubmit="return confirm('Tem certeza que deseja excluir a categoria {{ addslashes($c->nome) }}?\n\nEssa ação não poderá ser desfeita.')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm" title="Excluir categoria">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <i class="bi bi-tags"
                                    style="font-size:3rem;color:#ccc;display:block;margin-bottom:.75rem"></i>

                                <p class="text-muted mb-3" style="font-size:1.1rem">
                                    Nenhuma categoria cadastrada ainda.
                                </p>

                                <a href="{{ route('categorias.create') }}" class="btn btn-lg"
                                    style="background:#7b1fa2;color:#fff;border:none">
                                    <i class="bi bi-plus-lg me-2"></i>Criar primeira categoria
                                </a>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- Paginação --}}
        @if ($categorias->hasPages())
            <div class="card-footer bg-white">
                {{ $categorias->links() }}
            </div>
        @endif

    </div>
@endsection
