{{--
    View: admin/eventos/index.blade.php
    Descrição: Lista todos os eventos da loja com filtros e modal de ajuda
--}}
@extends('admin.layouts.app')

@section('content')

    {{-- Cabeçalho --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-calendar-event-fill me-2" style="color:#c9a84c"></i>
                Eventos da Loja
            </h3>
            <p class="text-muted mb-0">
                Gerencie os eventos cadastrados —
                <strong>{{ $eventos->total() }}</strong>
                {{ $eventos->total() === 1 ? 'evento encontrado' : 'eventos encontrados' }}
            </p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-ajuda">
                <i class="bi bi-question-circle-fill me-1"></i>Ajuda
            </button>
            <a href="{{ route('eventos.create') }}" class="btn btn-lg" style="background:#1a3a5c;color:#fff;border:none">
                <i class="bi bi-plus-circle-fill me-2"></i>Novo Evento
            </a>
        </div>
    </div>

    {{-- Modal de ajuda --}}
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
                        Esta tela gerencia os <strong>Eventos da Loja</strong> — festas, jantares,
                        palestras, visitas e comemorações. Os eventos aparecem na página inicial do site
                        para que os irmãos e visitantes possam se programar.
                    </p>
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-hand-index me-1"></i>O que cada botão faz:
                    </h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#e8f0fe">
                                <span class="btn btn-primary btn-sm" style="pointer-events:none">
                                    <i class="bi bi-pencil-fill"></i>
                                </span>
                                <div>
                                    <strong>Editar</strong>
                                    <div class="text-muted small">Altera os dados do evento</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#fce4ec">
                                <span class="btn btn-danger btn-sm" style="pointer-events:none">
                                    <i class="bi bi-trash-fill"></i>
                                </span>
                                <div>
                                    <strong>Remover</strong>
                                    <div class="text-muted small">Exclui o evento permanentemente</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-flag me-1"></i>Status dos eventos:
                    </h6>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success">Agendado</span>
                            <small class="text-muted">Data futura, visível no site</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary">Realizado</span>
                            <small class="text-muted">Data já passou</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge" style="background:#c9a84c">Destaque</span>
                            <small class="text-muted">Aparece em posição de destaque na home</small>
                        </div>
                    </div>
                    <div class="alert mb-0" style="background:#e8f5e9;border-left:4px solid #2e7d32">
                        <i class="bi bi-lightbulb-fill me-2" style="color:#2e7d32"></i>
                        <strong>Dica:</strong> Marque a opção <strong>Destaque</strong> nos eventos mais
                        importantes para que apareçam em posição privilegiada na página inicial.
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

    {{-- Filtros --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white">
            <i class="bi bi-funnel-fill me-2" style="color:#2c5f8a"></i>
            <strong>Filtrar Eventos</strong>
            <small class="text-muted ms-2">Preencha os campos desejados e clique em Filtrar</small>
        </div>
        <div class="card-body pt-3">
            <form method="GET" action="{{ route('eventos.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Tipo de Evento</label>
                        <select name="tipo" class="form-select">
                            <option value="">— Todos —</option>
                            @foreach ([
            'geral' => 'Geral',
            'jantar' => 'Jantar Ritualístico',
            'palestra' => 'Palestra',
            'festa' => 'Festa / Confraternização',
            'visita' => 'Visita a outra Loja',
            'comemora' => 'Comemoração',
            'externo' => 'Evento Externo',
            'beneficente' => 'Ação Beneficente',
        ] as $val => $label)
                                <option value="{{ $val }}" {{ request('tipo') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Período</label>
                        <select name="periodo" class="form-select">
                            <option value="">— Todos —</option>
                            <option value="futuros" {{ request('periodo') === 'futuros' ? 'selected' : '' }}>Apenas futuros
                            </option>
                            <option value="passados" {{ request('periodo') === 'passados' ? 'selected' : '' }}>Apenas
                                realizados</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Visibilidade</label>
                        <select name="publicado" class="form-select">
                            <option value="">— Todos —</option>
                            <option value="1" {{ request('publicado') === '1' ? 'selected' : '' }}>Visíveis no site
                            </option>
                            <option value="0" {{ request('publicado') === '0' ? 'selected' : '' }}>Ocultos</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="bi bi-search me-1"></i>Filtrar
                            </button>
                            <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i>Limpar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabela --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#1a3a5c">
                    <tr>
                        <th style="width:70px;padding:1rem .75rem"></th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">EVENTO</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">TIPO</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">DATA</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">LOCAL</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">STATUS</th>
                        <th style="color:#c9a84c;font-size:.8rem;padding:1rem .75rem;text-align:center;width:120px">AÇÕES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($eventos as $evento)
                        <tr style="font-size:1rem" class="{{ $evento->is_futuro ? '' : 'table-light' }}">

                            {{-- Foto ou ícone --}}
                            <td style="padding:.85rem .75rem">
                                @if ($evento->foto_capa)
                                    <img src="{{ asset('storage/' . $evento->foto_capa) }}"
                                        style="width:56px;height:46px;object-fit:cover;border-radius:6px"
                                        alt="{{ $evento->titulo }}">
                                @else
                                    <div
                                        style="width:56px;height:46px;border-radius:6px;display:flex;align-items:center;justify-content:center;background:{{ $evento->tipo_cor }}22">
                                        <i class="bi bi-calendar-event"
                                            style="color:{{ $evento->tipo_cor }};font-size:1.4rem"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Título e destaque --}}
                            <td style="padding:.85rem .75rem">
                                <div class="fw-bold" style="color:#1a1a2e;font-size:1rem">
                                    {{ $evento->titulo }}
                                    @if ($evento->destaque)
                                        <span class="badge ms-1" style="background:#c9a84c;color:#fff;font-size:.7rem">
                                            &#9733; Destaque
                                        </span>
                                    @endif
                                </div>
                                @if ($evento->descricao)
                                    <div class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($evento->descricao), 60) }}
                                    </div>
                                @endif
                            </td>

                            {{-- Tipo --}}
                            <td style="padding:.85rem .75rem">
                                <span class="badge"
                                    style="background:{{ $evento->tipo_cor }};color:#fff;font-size:.82rem;padding:.4em .7em">
                                    {{ $evento->tipo_label }}
                                </span>
                            </td>

                            {{-- Data --}}
                            <td style="padding:.85rem .75rem">
                                <div class="fw-semibold" style="color:#1a3a5c">
                                    {{ $evento->periodo }}
                                </div>
                                <small class="text-muted">{{ $evento->dia_semana }}</small>
                                @if ($evento->horario_inicio)
                                    <div style="font-size:.85rem;color:#666">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_inicio)->format('H\hi') }}
                                    </div>
                                @endif
                            </td>

                            {{-- Local --}}
                            <td style="padding:.85rem .75rem;font-size:.9rem;color:#555">
                                {{ $evento->local_nome ?? '—' }}
                                @if ($evento->link_maps || $evento->link_waze)
                                    <div class="d-flex gap-1 mt-1">
                                        @if ($evento->link_maps)
                                            <a href="{{ $evento->link_maps }}" target="_blank"
                                                class="badge text-decoration-none" style="background:#4285f4;color:#fff">
                                                <i class="bi bi-map-fill me-1"></i>Maps
                                            </a>
                                        @endif
                                        @if ($evento->link_waze)
                                            <a href="{{ $evento->link_waze }}" target="_blank"
                                                class="badge text-decoration-none" style="background:#33ccff;color:#111">
                                                <i class="bi bi-navigation-fill me-1"></i>Waze
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td style="padding:.85rem .75rem">
                                @if (!$evento->publicado)
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-eye-slash me-1"></i>Oculto
                                    </span>
                                @elseif($evento->is_futuro)
                                    <span class="badge bg-success">
                                        <i class="bi bi-calendar-check me-1"></i>Agendado
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-check2-circle me-1"></i>Realizado
                                    </span>
                                @endif
                                @if ($evento->aberto_publico)
                                    <div class="mt-1">
                                        <span class="badge" style="background:#e8f5e9;color:#2e7d32;font-size:.72rem">
                                            <i class="bi bi-people me-1"></i>Aberto ao público
                                        </span>
                                    </div>
                                @endif
                            </td>

                            {{-- Ações --}}
                            <td style="padding:.85rem .75rem;text-align:center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-primary btn-sm"
                                        title="Editar evento" style="min-width:38px">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST" action="{{ route('eventos.destroy', $evento) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Remover o evento:\n\n{{ addslashes($evento->titulo) }}\n\nEsta ação não pode ser desfeita.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Remover evento"
                                            style="min-width:38px">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-calendar-x"
                                    style="font-size:3rem;color:#ccc;display:block;margin-bottom:.75rem"></i>
                                <p class="text-muted mb-3" style="font-size:1.1rem">
                                    @if (request('tipo') || request('periodo') || request('publicado'))
                                        Nenhum evento encontrado com os filtros aplicados.
                                    @else
                                        Nenhum evento cadastrado ainda.
                                    @endif
                                </p>
                                @if (request('tipo') || request('periodo') || request('publicado'))
                                    <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-x-circle me-1"></i>Limpar filtros
                                    </a>
                                @endif
                                <a href="{{ route('eventos.create') }}" class="btn btn-lg"
                                    style="background:#1a3a5c;color:#fff;border:none">
                                    <i class="bi bi-plus-circle-fill me-2"></i>Cadastrar primeiro evento
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($eventos->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Exibindo {{ $eventos->firstItem() }}–{{ $eventos->lastItem() }}
                    de <strong>{{ $eventos->total() }}</strong> eventos
                </small>
                <div>{{ $eventos->links() }}</div>
            </div>
        @endif
    </div>

@endsection
