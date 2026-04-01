@extends('admin.layouts.app')

@section('content')
    {{-- ── Cabeçalho com título, descrição e botão principal ── --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-newspaper me-2" style="color:#c9a84c"></i>
                Notícias da Loja
            </h3>
            <p class="text-muted mb-0">
                Gerencie todas as notícias publicadas no portal —
                <strong>{{ $noticias->total() }}</strong>
                {{ $noticias->total() === 1 ? 'notícia cadastrada' : 'notícias cadastradas' }}
            </p>
        </div>

        <div class="d-flex gap-2 align-items-center">

            {{-- Botão de ajuda --}}
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-ajuda"
                title="Como usar esta tela">
                <i class="bi bi-question-circle-fill me-1"></i>Ajuda
            </button>

            {{-- Botão principal --}}
            <a href="{{ route('noticias.create') }}" class="btn btn-lg" style="background:#7b1fa2;color:#fff">
                <i class="bi bi-plus-lg me-1"></i>Nova Notícia
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
                        Esta é a tela de <strong>gestão das notícias da loja</strong>.
                        Aqui você pode cadastrar, editar, visualizar e excluir notícias do portal.
                    </p>

                    {{-- Funções --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-hand-index me-1"></i> O que cada botão faz:
                    </h6>

                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#e8f0fe">
                                <span class="btn btn-secondary btn-sm" style="pointer-events:none">
                                    <i class="bi bi-eye"></i>
                                </span>
                                <div>
                                    <strong>Visualizar</strong>
                                    <div class="text-muted small">
                                        Abre a notícia no site público
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#e8f0fe">
                                <span class="btn btn-primary btn-sm" style="pointer-events:none">
                                    <i class="bi bi-pencil"></i>
                                </span>
                                <div>
                                    <strong>Editar</strong>
                                    <div class="text-muted small">
                                        Altera os dados da notícia
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#fce4ec">
                                <span class="btn btn-danger btn-sm" style="pointer-events:none">
                                    <i class="bi bi-trash"></i>
                                </span>
                                <div>
                                    <strong>Excluir</strong>
                                    <div class="text-muted small">
                                        Remove a notícia permanentemente
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Status --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-flag me-1"></i> Status das notícias:
                    </h6>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <span class="badge bg-success fs-6 px-3 py-2">
                            Publicado
                        </span>
                        <span class="badge bg-secondary fs-6 px-3 py-2">
                            Rascunho
                        </span>
                    </div>

                    {{-- Dica --}}
                    <div class="alert mb-0" style="background:#e8f5e9;border-left:4px solid #2e7d32">
                        <i class="bi bi-lightbulb-fill me-2" style="color:#2e7d32"></i>
                        <strong>Dica:</strong> Utilize categorias para organizar melhor as notícias.
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
 TABELA DE NOTÍCIAS
 ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle">

                <thead style="background:#1a3a5c;color:#fff">
                    <tr>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($noticias as $n)
                        <tr>

                            <td>
                                <strong>{{ $n->titulo }}</strong>
                            </td>

                            <td>
                                @if ($n->categoria)
                                    <span class="badge bg-info text-dark">
                                        {{ $n->categoria->nome }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            <td>
                                @if ($n->publicado)
                                    <span class="badge bg-success">Publicado</span>
                                @else
                                    <span class="badge bg-secondary">Rascunho</span>
                                @endif
                            </td>

                            <td>{{ $n->created_at->format('d/m/Y') }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">

                                    <a href="/noticias/{{ $n->slug }}" target="_blank"
                                        class="btn btn-sm btn-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('noticias.edit', $n) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form method="POST" action="{{ route('noticias.destroy', $n) }}"
                                        onsubmit="return confirm('Deseja excluir esta notícia?')">
                                        @csrf @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-newspaper"
                                    style="font-size:3rem;color:#ccc;display:block;margin-bottom:.75rem"></i>

                                <p class="text-muted mb-3" style="font-size:1.1rem">
                                    Nenhuma notícia cadastrada ainda.
                                </p>

                                <a href="{{ route('noticias.create') }}" class="btn btn-lg"
                                    style="background:#7b1fa2;color:#fff">
                                    <i class="bi bi-plus-lg me-2"></i>Criar primeira notícia
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{ $noticias->links() }}
        </div>
    </div>
@endsection
