{{--
    ============================================================
    View: admin/sessoes/index.blade.php
    Descrição: Lista todas as sessões do calendário da loja
    Segue o mesmo padrão visual e de usabilidade do sistema,
    incluindo botão de ajuda com modal explicativo.
    ============================================================
--}}
@extends('admin.layouts.app')

@section('content')
    {{-- ── Cabeçalho com título, descrição e botões principais ── --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-calendar3 me-2" style="color:#c9a84c"></i>
                Calendário de Sessões
            </h3>
            <p class="text-muted mb-0">
                Gerencie as sessões agendadas da loja —
                <strong>{{ $sessoes->total() }}</strong>
                {{ $sessoes->total() === 1 ? 'sessão cadastrada' : 'sessões cadastradas' }}
            </p>
        </div>

        <div class="d-flex gap-2 align-items-center">

            {{-- Botão de ajuda: abre modal com instruções de uso --}}
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-ajuda"
                title="Como usar esta tela">
                <i class="bi bi-question-circle-fill me-1"></i>Ajuda
            </button>

            {{-- Botão principal: cadastrar nova sessão --}}
            <a href="{{ route('sessoes.create') }}" class="btn btn-lg" style="background:#1a3a5c;color:#fff;border:none">
                <i class="bi bi-plus-circle-fill me-2"></i>Nova Sessão
            </a>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
     MODAL DE AJUDA
     Explica como usar a tela para usuários menos experientes
     ════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="modal-ajuda" tabindex="-1" aria-labelledby="modal-ajuda-titulo" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">

                <div class="modal-header" style="background:#1a3a5c">
                    <h5 class="modal-title text-white fw-bold" id="modal-ajuda-titulo">
                        <i class="bi bi-question-circle-fill me-2" style="color:#c9a84c"></i>
                        Como usar esta tela
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fechar"></button>
                </div>

                <div class="modal-body p-4" style="font-size:1.05rem">

                    {{-- Descrição geral --}}
                    <p class="mb-4">
                        Esta é a tela de <strong>gestão do Calendário de Sessões</strong> da Loja.
                        Aqui você pode cadastrar, editar e remover as sessões que aparecem
                        na página inicial do site para que os Irmãos possam se programar.
                    </p>

                    {{-- O que cada botão faz --}}
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
                                        Altera os dados da sessão (data, horário, nome, grau, rito)
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
                                    <strong>Remover</strong>
                                    <div class="text-muted small">
                                        Exclui a sessão permanentemente do calendário
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Legenda dos status --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-flag me-1"></i> Significado de cada Status:
                    </h6>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success" style="font-size:.85rem;padding:.4em .75em">
                                Agendada
                            </span>
                            <small class="text-muted">Sessão futura, visível no site</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary" style="font-size:.85rem;padding:.4em .75em">
                                Realizada
                            </span>
                            <small class="text-muted">Data já passou, ainda visível no histórico</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary" style="font-size:.85rem;padding:.4em .75em">
                                Oculta
                            </span>
                            <small class="text-muted">Não aparece no site público</small>
                        </div>
                    </div>

                    {{-- Legenda das cores de grau --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-award me-1"></i> Cores dos Graus Maçônicos:
                    </h6>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                            <i class="bi bi-circle-fill me-1"></i>1° Grau — Aprendiz
                        </span>
                        <span class="badge bg-info text-dark fs-6 px-3 py-2">
                            <i class="bi bi-circle-fill me-1"></i>2° Grau — Companheiro
                        </span>
                        <span class="badge bg-primary fs-6 px-3 py-2">
                            <i class="bi bi-circle-fill me-1"></i>3° Grau — Mestre
                        </span>
                    </div>

                    {{-- Dica sobre visibilidade --}}
                    <div class="alert mb-3" style="background:#e8f5e9;border-left:4px solid #2e7d32">
                        <i class="bi bi-lightbulb-fill me-2" style="color:#2e7d32"></i>
                        <strong>Dica — Visibilidade no Site:</strong> Ao cadastrar ou editar uma sessão,
                        marque a opção <strong>"Exibir na página inicial do site"</strong> para que ela
                        apareça no calendário público. Sessões desmarcadas ficam ocultas para os visitantes.
                    </div>

                    {{-- Dica sobre linhas esmaecidas --}}
                    <div class="alert mb-0" style="background:#fff3e0;border-left:4px solid #e65100">
                        <i class="bi bi-info-circle-fill me-2" style="color:#e65100"></i>
                        <strong>Linhas esmaecidas:</strong> Sessões com fundo cinza claro já foram
                        realizadas (a data já passou). Elas são mantidas no sistema como histórico,
                        mas podem ser removidas quando desejar.
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
     PAINEL DE FILTROS
     ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white">
            <i class="bi bi-funnel-fill me-2" style="color:#2c5f8a"></i>
            <strong>Filtrar Sessões</strong>
            <small class="text-muted ms-2">Preencha um ou mais campos e clique em Filtrar</small>
        </div>
        <div class="card-body pt-3">
            <form method="GET" action="{{ route('sessoes.index') }}">
                <div class="row g-3 align-items-end">

                    {{-- Filtro por grau --}}
                    <div class="col-md-3">
                        <label class="form-label" for="grau">
                            <i class="bi bi-award me-1"></i>Grau da Sessão
                        </label>
                        <select id="grau" name="grau" class="form-select">
                            <option value="">— Todos os graus —</option>
                            <option value="1" {{ request('grau') == '1' ? 'selected' : '' }}>1° Grau — Aprendiz
                            </option>
                            <option value="2" {{ request('grau') == '2' ? 'selected' : '' }}>2° Grau — Companheiro
                            </option>
                            <option value="3" {{ request('grau') == '3' ? 'selected' : '' }}>3° Grau — Mestre</option>
                        </select>
                    </div>

                    {{-- Filtro por período --}}
                    <div class="col-md-3">
                        <label class="form-label" for="periodo">
                            <i class="bi bi-calendar-range me-1"></i>Período
                        </label>
                        <select id="periodo" name="periodo" class="form-select">
                            <option value="">— Todas —</option>
                            <option value="futuras" {{ request('periodo') === 'futuras' ? 'selected' : '' }}>Apenas
                                futuras</option>
                            <option value="passadas" {{ request('periodo') === 'passadas' ? 'selected' : '' }}>Apenas
                                realizadas</option>
                        </select>
                    </div>

                    {{-- Filtro por visibilidade --}}
                    <div class="col-md-3">
                        <label class="form-label" for="publicado">
                            <i class="bi bi-eye me-1"></i>Visibilidade
                        </label>
                        <select id="publicado" name="publicado" class="form-select">
                            <option value="">— Todas —</option>
                            <option value="1" {{ request('publicado') === '1' ? 'selected' : '' }}>Visíveis no site
                            </option>
                            <option value="0" {{ request('publicado') === '0' ? 'selected' : '' }}>Ocultas</option>
                        </select>
                    </div>

                    {{-- Botões do filtro --}}
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="bi bi-search me-1"></i>Filtrar
                            </button>
                            <a href="{{ route('sessoes.index') }}" class="btn btn-outline-secondary"
                                title="Limpar todos os filtros">
                                <i class="bi bi-x-circle me-1"></i>Limpar
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
     TABELA DE SESSÕES
     ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead style="background:#1a3a5c">
                    <tr>
                        <th style="color:#c9a84c;font-size:.8rem;padding:1rem .75rem">DATA</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">NOME DA SESSÃO</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">GRAU</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">HORÁRIO</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">RITO</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">STATUS</th>
                        <th style="color:#c9a84c;font-size:.8rem;padding:1rem .75rem;text-align:center;width:120px">
                            AÇÕES
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sessoes as $sessao)
                        {{-- Linha esmaecida para sessões já realizadas --}}
                        <tr style="font-size:1rem" class="{{ $sessao->is_futura ? '' : 'table-light' }}">

                            {{-- Data com dia da semana --}}
                            <td style="padding:.85rem .75rem">
                                <div class="fw-bold" style="color:#1a3a5c;font-size:1.05rem">
                                    {{ $sessao->data->format('d/m/Y') }}
                                </div>
                                <small class="text-muted">{{ $sessao->dia_semana }}</small>
                            </td>

                            {{-- Nome da sessão com observação resumida --}}
                            <td style="padding:.85rem .75rem">
                                <span class="fw-semibold">{{ $sessao->nome }}</span>
                                @if ($sessao->observacoes)
                                    <div class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit($sessao->observacoes, 60) }}
                                    </div>
                                @endif
                            </td>

                            {{-- Badge colorido do grau --}}
                            <td style="padding:.85rem .75rem">
                                @php
                                    $grauCores = [1 => '#ffc107', 2 => '#0dcaf0', 3 => '#0d6efd'];
                                    $grauTexto = [1 => '#333', 2 => '#333', 3 => '#fff'];
                                    $bg = $grauCores[$sessao->grau] ?? '#6c757d';
                                    $tx = $grauTexto[$sessao->grau] ?? '#fff';
                                @endphp
                                <span class="badge"
                                    style="background:{{ $bg }};color:{{ $tx }};font-size:.85rem;padding:.4em .75em">
                                    {{ $sessao->grau }}° Grau
                                </span>
                            </td>

                            {{-- Horários de início e encerramento --}}
                            <td style="padding:.85rem .75rem">
                                <i class="bi bi-clock me-1 text-muted"></i>
                                <strong>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $sessao->horario_inicio)->format('H\hi') }}
                                </strong>
                                @if ($sessao->horario_encerramento)
                                    <span class="text-muted">
                                        —
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $sessao->horario_encerramento)->format('H\hi') }}
                                    </span>
                                @endif
                            </td>

                            {{-- Rito praticado --}}
                            <td style="padding:.85rem .75rem;font-size:.9rem;color:#555">
                                {{ $sessao->rito }}
                            </td>

                            {{-- Badge de status --}}
                            <td style="padding:.85rem .75rem">
                                @if (!$sessao->publicado)
                                    <span class="badge"
                                        style="background:#6c757d;color:#fff;font-size:.82rem;padding:.4em .7em">
                                        <i class="bi bi-eye-slash me-1"></i>Oculta
                                    </span>
                                @elseif($sessao->is_futura)
                                    <span class="badge"
                                        style="background:#198754;color:#fff;font-size:.82rem;padding:.4em .7em">
                                        <i class="bi bi-calendar-check me-1"></i>Agendada
                                    </span>
                                @else
                                    <span class="badge"
                                        style="background:#6c757d;color:#fff;font-size:.82rem;padding:.4em .7em">
                                        <i class="bi bi-check2-circle me-1"></i>Realizada
                                    </span>
                                @endif
                            </td>

                            {{-- Botões de ação --}}
                            <td style="padding:.85rem .75rem;text-align:center">
                                <div class="d-flex gap-1 justify-content-center">

                                    {{-- Editar sessão --}}
                                    <a href="{{ route('sessoes.edit', $sessao) }}" class="btn btn-primary btn-sm"
                                        title="Editar esta sessão" style="min-width:38px">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    {{-- Remover sessão --}}
                                    <form method="POST" action="{{ route('sessoes.destroy', $sessao) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Remover a sessão:\n\n{{ addslashes($sessao->nome) }}\n\nEsta ação não pode ser desfeita.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            title="Remover esta sessão permanentemente" style="min-width:38px">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Estado vazio --}}
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-calendar-x"
                                    style="font-size:3rem;color:#ccc;display:block;margin-bottom:.75rem"></i>
                                <p class="text-muted mb-3" style="font-size:1.1rem">
                                    @if (request('grau') || request('periodo') || request('publicado'))
                                        Nenhuma sessão encontrada com os filtros aplicados.
                                    @else
                                        Nenhuma sessão cadastrada ainda.
                                    @endif
                                </p>
                                @if (request('grau') || request('periodo') || request('publicado'))
                                    <a href="{{ route('sessoes.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-x-circle me-1"></i>Limpar filtros
                                    </a>
                                @endif
                                <a href="{{ route('sessoes.create') }}" class="btn btn-lg"
                                    style="background:#1a3a5c;color:#fff;border:none">
                                    <i class="bi bi-plus-circle-fill me-2"></i>Cadastrar primeira sessão
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Rodapé com paginação e totalizador --}}
        @if ($sessoes->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Exibindo {{ $sessoes->firstItem() }}–{{ $sessoes->lastItem() }}
                    de <strong>{{ $sessoes->total() }}</strong> sessões
                </small>
                <div>{{ $sessoes->links() }}</div>
            </div>
        @endif
    </div>
@endsection
