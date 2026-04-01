{{--
    ============================================================
    View: admin/membros/show.blade.php
    Descrição: Perfil completo do Irmão Maçom
    Exibe dados maçônicos, pessoais, família e histórico de cargos
    ============================================================
--}}
@extends('admin.layouts.app')

@section('content')

    {{-- ════════════════════════════════════════════════════════
     CABEÇALHO DO PERFIL
     Foto, nome, grau, situação e botões de ação
     ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm mb-4" style="background:linear-gradient(135deg, #1a3a5c, #2c5f8a)">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                {{-- Foto + nome + badges --}}
                <div class="d-flex align-items-center gap-4">

                    {{-- Foto do irmão --}}
                    @if ($membro->foto)
                        <img src="{{ asset('storage/' . $membro->foto) }}" class="rounded-circle border border-3 shadow"
                            style="width:100px;height:100px;object-fit:cover;border-color:#c9a84c !important"
                            alt="Foto de {{ $membro->nome_completo }}">
                    @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow"
                            style="width:100px;height:100px;background:rgba(255,255,255,.15);border:3px solid #c9a84c">
                            <i class="bi bi-person-fill text-white" style="font-size:2.5rem"></i>
                        </div>
                    @endif

                    {{-- Informações principais --}}
                    <div>
                        <h3 class="mb-1 fw-bold text-white">{{ $membro->nome_completo }}</h3>
                        @if ($membro->nome_maconico)
                            <div class="mb-2" style="color:#c9a84c;font-size:1.05rem">
                                <i class="bi bi-pentagon-fill me-1"></i>
                                {{ $membro->nome_maconico }}
                            </div>
                        @endif

                        {{-- Badges de grau, situação e cargo --}}
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $grauEstilos = [
                                    1 => ['bg' => '#ffc107', 'color' => '#333'],
                                    2 => ['bg' => '#0dcaf0', 'color' => '#333'],
                                    3 => ['bg' => '#0d6efd', 'color' => '#fff'],
                                ];
                                $ge = $grauEstilos[$membro->grau] ?? ['bg' => '#6c757d', 'color' => '#fff'];
                                $situacaoCores = [
                                    'ativo' => '#198754',
                                    'inativo' => '#6c757d',
                                    'suspenso' => '#dc3545',
                                    'remido' => '#0dcaf0',
                                    'benemerito' => '#0d6efd',
                                    'fundador' => '#212529',
                                    'transferido' => '#fd7e14',
                                    'falecido' => '#343a40',
                                ];
                                $sc = $situacaoCores[$membro->situacao] ?? '#6c757d';
                            @endphp
                            <span class="badge fs-6 px-3 py-2"
                                style="background:{{ $ge['bg'] }};color:{{ $ge['color'] }}">
                                {{ $membro->grau_nome }}
                            </span>
                            <span class="badge fs-6 px-3 py-2" style="background:{{ $sc }}">
                                {{ ucfirst($membro->situacao) }}
                            </span>
                            @if ($membro->cargo_atual)
                                <span class="badge fs-6 px-3 py-2"
                                    style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.4)">
                                    <i class="bi bi-star-fill me-1" style="color:#c9a84c"></i>
                                    {{ $membro->cargo_atual }}
                                </span>
                            @endif
                            @if ($membro->cim)
                                <span class="badge fs-6 px-3 py-2" style="background:rgba(255,255,255,.15);color:#fff">
                                    <i class="bi bi-hash me-1"></i>CIM {{ $membro->cim }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Botões de ação --}}
                <div class="d-flex flex-wrap gap-2">
                    <a href="/admin/membros/{{ $membro->id }}/edit" class="btn btn-lg"
                        style="background:#c9a84c;color:#fff;border:none">
                        <i class="bi bi-pencil-fill me-2"></i>Editar Dados
                    </a>
                    <a href="/admin/membros" class="btn btn-lg btn-outline-light">
                        <i class="bi bi-arrow-left me-2"></i>Voltar à Lista
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
     CONTEÚDO: COLUNA PRINCIPAL + COLUNA LATERAL
     ════════════════════════════════════════════════════════ --}}
    <div class="row g-4">

        {{-- ── Coluna principal (8/12) ── --}}
        <div class="col-lg-8">

            {{-- Card: Dados Maçônicos --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header" style="background:#1a3a5c;color:#fff">
                    <i class="bi bi-pentagon-fill me-2" style="color:#c9a84c"></i>
                    <strong>Dados Maçônicos</strong>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">

                        <div class="col-sm-4">
                            <div class="p-3 rounded" style="background:#f0f4f8">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                    style="font-size:.75rem">CIM</small>
                                <span class="font-monospace fw-bold" style="font-size:1.1rem;color:#1a3a5c">
                                    {{ $membro->cim ?? '—' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 rounded" style="background:#f0f4f8">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">Tipo
                                    de Membro</small>
                                <span style="font-size:1rem">{{ ucfirst($membro->tipo_membro ?? '—') }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 rounded" style="background:#f0f4f8">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">Data
                                    de Iniciação</small>
                                <span style="font-size:1rem">{{ $membro->data_iniciacao?->format('d/m/Y') ?? '—' }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 rounded" style="background:#f0f4f8">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">Data
                                    de Elevação</small>
                                <span style="font-size:1rem">{{ $membro->data_elevacao?->format('d/m/Y') ?? '—' }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 rounded" style="background:#f0f4f8">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">Data
                                    de Exaltação</small>
                                <span style="font-size:1rem">{{ $membro->data_exaltacao?->format('d/m/Y') ?? '—' }}</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 rounded" style="background:#f0f4f8">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                    style="font-size:.75rem">Filiação nesta Loja</small>
                                <span
                                    style="font-size:1rem">{{ $membro->data_filiacao_loja?->format('d/m/Y') ?? '—' }}</span>
                            </div>
                        </div>

                        @if ($membro->loja_origem)
                            <div class="col-12">
                                <div class="p-3 rounded" style="background:#fff3cd">
                                    <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">
                                        <i class="bi bi-arrow-right-circle me-1"></i>Loja de Origem (Transferido)
                                    </small>
                                    <span style="font-size:1rem">{{ $membro->loja_origem }}</span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Card: Dados Pessoais --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header" style="background:#f8f9fa;border-bottom:2px solid #0d6efd">
                    <i class="bi bi-person-fill me-2 text-primary"></i>
                    <strong>Dados Pessoais e Contato</strong>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">

                        <div class="col-sm-4">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                style="font-size:.75rem">Nascimento / Idade</small>
                            <span style="font-size:1rem">
                                {{ $membro->data_nascimento?->format('d/m/Y') ?? '—' }}
                                @if ($membro->data_nascimento)
                                    <span class="badge bg-light text-dark border ms-1">{{ $membro->idade }} anos</span>
                                @endif
                            </span>
                        </div>

                        <div class="col-sm-4">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">Estado
                                Civil</small>
                            <span style="font-size:1rem">
                                {{ $membro->estado_civil ? ucfirst(str_replace('_', ' ', $membro->estado_civil)) : '—' }}
                            </span>
                        </div>

                        <div class="col-sm-4">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                style="font-size:.75rem">Profissão</small>
                            <span style="font-size:1rem">{{ $membro->profissao ?? '—' }}</span>
                        </div>

                        <div class="col-sm-4">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                style="font-size:.75rem">CPF</small>
                            <span class="font-monospace" style="font-size:1rem">{{ $membro->cpf ?? '—' }}</span>
                        </div>

                        <div class="col-sm-4">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                style="font-size:.75rem">RG</small>
                            <span style="font-size:1rem">
                                {{ $membro->rg ?? '—' }}
                                @if ($membro->orgao_expedidor)
                                    <span class="text-muted"> / {{ $membro->orgao_expedidor }}</span>
                                @endif
                            </span>
                        </div>

                        <div class="col-sm-4">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                style="font-size:.75rem">Naturalidade</small>
                            <span style="font-size:1rem">{{ $membro->naturalidade ?? '—' }}</span>
                        </div>

                        {{-- Contatos --}}
                        <div class="col-12">
                            <hr class="my-1">
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">
                                <i class="bi bi-envelope me-1"></i>E-mail Principal
                            </small>
                            <span style="font-size:1rem">
                                @if ($membro->email)
                                    <a href="mailto:{{ $membro->email }}"
                                        class="text-decoration-none">{{ $membro->email }}</a>
                                @else
                                    —
                                @endif
                            </span>
                        </div>

                        <div class="col-sm-3">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">
                                <i class="bi bi-phone me-1"></i>Celular
                            </small>
                            <span style="font-size:1rem">{{ $membro->celular ?? '—' }}</span>
                        </div>

                        <div class="col-sm-3">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">
                                <i class="bi bi-whatsapp me-1 text-success"></i>WhatsApp
                            </small>
                            <span style="font-size:1rem">{{ $membro->whatsapp ?? '—' }}</span>
                        </div>

                        {{-- Endereço --}}
                        @if ($membro->logradouro)
                            <div class="col-12">
                                <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size:.75rem">
                                    <i class="bi bi-geo-alt me-1"></i>Endereço
                                </small>
                                <span style="font-size:1rem">
                                    {{ $membro->logradouro }}, {{ $membro->numero }}
                                    @if ($membro->complemento)
                                        — {{ $membro->complemento }}
                                    @endif
                                    — {{ $membro->bairro }}, {{ $membro->cidade }}/{{ $membro->estado }}
                                    — CEP {{ $membro->cep }}
                                </span>
                            </div>
                        @endif

                        @if ($membro->observacoes)
                            <div class="col-12">
                                <div class="p-3 rounded" style="background:#fff8e1">
                                    <small class="text-muted d-block mb-1 text-uppercase fw-bold"
                                        style="font-size:.75rem">
                                        <i class="bi bi-sticky me-1"></i>Observações Internas
                                    </small>
                                    <span style="font-size:1rem">{{ $membro->observacoes }}</span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Card: Histórico de Cargos --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header" style="background:#f8f9fa;border-bottom:2px solid #c9a84c">
                    <i class="bi bi-award-fill me-2" style="color:#c9a84c"></i>
                    <strong>Histórico de Cargos na Loja</strong>
                </div>
                <div class="card-body p-4">

                    {{-- Formulário para adicionar novo cargo --}}
                    <form method="POST" action="/admin/membros/{{ $membro->id }}/cargos" class="mb-4">
                        @csrf
                        <p class="text-muted small mb-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Registre os cargos que este irmão exerceu na loja ao longo dos anos.
                        </p>
                        <div class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Cargo</label>
                                <input name="cargo" class="form-control" placeholder="Ex: Venerável Mestre" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold">Ano Início</label>
                                <input name="ano_inicio" type="number" class="form-control"
                                    placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') + 1 }}"
                                    required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold">Ano Fim</label>
                                <input name="ano_fim" type="number" class="form-control" placeholder="Em exercício"
                                    min="1900" max="{{ date('Y') + 1 }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Observação</label>
                                <input name="observacao" class="form-control" placeholder="Opcional">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary w-100" title="Adicionar cargo">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Lista de cargos --}}
                    @forelse($membro->historicoCargos as $cargo)
                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                            <div>
                                <strong style="font-size:1.05rem">{{ $cargo->cargo }}</strong>
                                <span class="badge ms-2" style="background:#e8f0fe;color:#1a3a5c;font-size:.85rem">
                                    {{ $cargo->vigencia }}
                                </span>
                                @if ($cargo->observacao)
                                    <small class="text-muted d-block mt-1">{{ $cargo->observacao }}</small>
                                @endif
                            </div>
                            <form method="POST" action="/admin/membros/cargos/{{ $cargo->id }}">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Remover este cargo do histórico?')"
                                    class="btn btn-danger btn-sm" title="Remover cargo">
                                    <i class="bi bi-trash-fill me-1"></i>Remover
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-award"
                                style="font-size:2rem;color:#ccc;display:block;margin-bottom:.5rem"></i>
                            <p class="text-muted">Nenhum cargo registrado ainda.</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>{{-- fim col-lg-8 --}}

        {{-- ── Coluna lateral: Família (4/12) ── --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header" style="background:#fce4ec;border-bottom:2px solid #dc3545">
                    <i class="bi bi-heart-fill me-2 text-danger"></i>
                    <strong>Família</strong>
                    <small class="text-muted ms-1">— Esposa e filhos</small>
                </div>
                <div class="card-body p-3">

                    {{-- Formulário para adicionar familiar --}}
                    <div class="p-3 rounded mb-3" style="background:#f8f9fa;border:1px solid #dee2e6">
                        <p class="text-muted small mb-2 fw-semibold">
                            <i class="bi bi-person-plus me-1"></i>Adicionar familiar
                        </p>
                        <form method="POST" action="/admin/membros/{{ $membro->id }}/familiares">
                            @csrf
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label small">Parentesco</label>
                                    <select name="parentesco" class="form-select form-select-sm" required>
                                        <option value="">— Selecione —</option>
                                        <option value="esposa">Esposa</option>
                                        <option value="filho">Filho</option>
                                        <option value="filha">Filha</option>
                                        <option value="enteado">Enteado</option>
                                        <option value="enteada">Enteada</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small">Nome</label>
                                    <input name="nome" class="form-control form-control-sm"
                                        placeholder="Nome completo" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small">Nascimento</label>
                                    <input name="data_nascimento" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small">Casamento</label>
                                    <input name="data_casamento" type="date" class="form-control form-control-sm"
                                        title="Data de casamento (somente para esposa)">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small">E-mail para felicitações</label>
                                    <input name="email" type="email" class="form-control form-control-sm"
                                        placeholder="email@exemplo.com">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input name="recebe_felicitacao" type="checkbox" class="form-check-input"
                                            id="ref" checked>
                                        <label class="form-check-label small" for="ref">
                                            <i class="bi bi-envelope-heart me-1 text-success"></i>
                                            Recebe felicitações automáticas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-plus-circle me-1"></i>Adicionar Familiar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr class="my-2">

                    {{-- Lista de familiares cadastrados --}}
                    @forelse($membro->familiares as $familiar)
                        <div class="d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
                            <div class="flex-grow-1">
                                {{-- Ícone por parentesco --}}
                                @php
                                    $icones = [
                                        'esposa' => ['icon' => 'heart-fill', 'color' => '#e91e63'],
                                        'filho' => ['icon' => 'person-fill', 'color' => '#1976d2'],
                                        'filha' => ['icon' => 'person-fill', 'color' => '#e91e63'],
                                        'enteado' => ['icon' => 'person', 'color' => '#1976d2'],
                                        'enteada' => ['icon' => 'person', 'color' => '#e91e63'],
                                    ];
                                    $ic = $icones[$familiar->parentesco] ?? ['icon' => 'person', 'color' => '#666'];
                                @endphp
                                <div class="fw-bold" style="font-size:1rem">
                                    <i class="bi bi-{{ $ic['icon'] }} me-1" style="color:{{ $ic['color'] }}"></i>
                                    {{ $familiar->nome }}
                                </div>
                                <small class="text-muted">{{ ucfirst($familiar->parentesco) }}</small>

                                @if ($familiar->data_nascimento)
                                    <div class="mt-1" style="font-size:.9rem">
                                        <i class="bi bi-cake me-1 text-warning"></i>
                                        {{ $familiar->data_nascimento->format('d/m/Y') }}
                                        {{-- Destaque se é aniversário hoje --}}
                                        @if ($familiar->aniversario_hoje)
                                            <span class="badge bg-warning text-dark ms-1">🎂 Hoje!</span>
                                        @endif
                                    </div>
                                @endif

                                @if ($familiar->data_casamento)
                                    <div class="mt-1" style="font-size:.9rem">
                                        <i class="bi bi-suit-heart me-1 text-danger"></i>
                                        Casamento: {{ $familiar->data_casamento->format('d/m/Y') }}
                                        @if ($familiar->aniversario_casamento_hoje)
                                            <span class="badge bg-danger ms-1">💑 Hoje!</span>
                                        @endif
                                    </div>
                                @endif

                                @if ($familiar->email)
                                    <div class="mt-1" style="font-size:.85rem;color:#555">
                                        <i class="bi bi-envelope me-1"></i>{{ $familiar->email }}
                                    </div>
                                @endif

                                @if ($familiar->recebe_felicitacao)
                                    <span class="badge mt-1" style="background:#e8f5e9;color:#2e7d32;font-size:.75rem">
                                        <i class="bi bi-envelope-heart me-1"></i>Recebe felicitações
                                    </span>
                                @endif
                            </div>

                            {{-- Botão remover familiar --}}
                            <form method="POST" action="/admin/membros/familiares/{{ $familiar->id }}" class="ms-2">
                                @csrf @method('DELETE')
                                <button
                                    onclick="return confirm('Remover {{ addslashes($familiar->nome) }} da lista de familiares?')"
                                    class="btn btn-danger btn-sm" title="Remover familiar">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-3">
                            <i class="bi bi-people"
                                style="font-size:2rem;color:#ccc;display:block;margin-bottom:.5rem"></i>
                            <p class="text-muted small">Nenhum familiar cadastrado ainda.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>{{-- fim col-lg-4 --}}

    </div>{{-- fim row --}}

@endsection
