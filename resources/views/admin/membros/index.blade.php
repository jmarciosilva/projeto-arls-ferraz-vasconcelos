{{--
    ============================================================
    View: admin/membros/index.blade.php
    Descrição: Lista todos os irmãos maçons cadastrados na loja
    com filtros de busca, paginação e ações rápidas.
    ============================================================
--}}
@extends('admin.layouts.app')

@section('content')
    {{-- ── Cabeçalho com título, descrição e botão principal ── --}}
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-people-fill me-2" style="color:#c9a84c"></i>
                Irmãos Membros da Loja
            </h3>
            <p class="text-muted mb-0">
                Quadro de Irmãos cadastrados —
                <strong>{{ $membros->total() }}</strong>
                {{ $membros->total() === 1 ? 'irmão encontrado' : 'irmãos encontrados' }}
            </p>
        </div>

        <div class="d-flex gap-2 align-items-center">
            {{-- Botão de ajuda --}}
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal-ajuda"
                title="Como usar esta tela">
                <i class="bi bi-question-circle-fill me-1"></i>Ajuda
            </button>

            {{-- Botão principal: cadastrar novo irmão --}}
            <a href="/admin/membros/create" class="btn btn-lg" style="background:#7b1fa2;color:#fff;border:none">
                <i class="bi bi-person-plus-fill me-2"></i>Cadastrar Novo Irmão
            </a>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
     MODAL DE AJUDA
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

                    <p class="mb-4">
                        Esta é a tela de <strong>gestão dos Irmãos Membros</strong> da Loja.
                        Aqui você pode consultar, cadastrar, editar e arquivar os dados de cada irmão.
                    </p>

                    {{-- Legenda dos botões --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-hand-index me-1"></i> O que cada botão faz:
                    </h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#e8f0fe">
                                <span class="btn btn-secondary btn-sm" style="pointer-events:none">
                                    <i class="bi bi-eye-fill"></i>
                                </span>
                                <div>
                                    <strong>Ver Perfil</strong>
                                    <div class="text-muted small">Visualiza todos os dados do irmão</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#e8f0fe">
                                <span class="btn btn-primary btn-sm" style="pointer-events:none">
                                    <i class="bi bi-pencil-fill"></i>
                                </span>
                                <div>
                                    <strong>Editar</strong>
                                    <div class="text-muted small">Altera os dados cadastrados</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-2 p-3 rounded" style="background:#fce4ec">
                                <span class="btn btn-danger btn-sm" style="pointer-events:none">
                                    <i class="bi bi-archive-fill"></i>
                                </span>
                                <div>
                                    <strong>Arquivar</strong>
                                    <div class="text-muted small">Oculta o irmão sem apagar os dados</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Legenda das cores de grau --}}
                    <h6 class="fw-bold mb-3" style="color:#1a3a5c">
                        <i class="bi bi-award me-1"></i> Cores dos Graus Maçônicos:
                    </h6>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                            <i class="bi bi-circle-fill me-1"></i>Aprendiz (1°)
                        </span>
                        <span class="badge bg-info text-dark fs-6 px-3 py-2">
                            <i class="bi bi-circle-fill me-1"></i>Companheiro (2°)
                        </span>
                        <span class="badge bg-primary fs-6 px-3 py-2">
                            <i class="bi bi-circle-fill me-1"></i>Mestre (3°)
                        </span>
                    </div>

                    {{-- Dica sobre filtros --}}
                    <div class="alert mb-0" style="background:#e8f5e9;border-left:4px solid #2e7d32">
                        <i class="bi bi-lightbulb-fill me-2" style="color:#2e7d32"></i>
                        <strong>Dica:</strong> Use os filtros para encontrar um irmão pelo nome,
                        pelo número CIM ou pela situação na loja.
                        Após filtrar, clique em <strong>Limpar</strong> para ver todos novamente.
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
            <strong>Filtrar Irmãos</strong>
            <small class="text-muted ms-2">Preencha um ou mais campos e clique em Filtrar</small>
        </div>
        <div class="card-body pt-3">
            <form method="GET" action="/admin/membros">
                <div class="row g-3 align-items-end">

                    {{-- Busca por texto --}}
                    <div class="col-md-4">
                        <label class="form-label" for="busca">
                            <i class="bi bi-search me-1"></i>Buscar por Nome ou CIM
                        </label>
                        <input type="text" id="busca" name="busca" class="form-control"
                            placeholder="Digite o nome, CIM ou nome simbólico..." value="{{ request('busca') }}"
                            autocomplete="off">
                    </div>

                    {{-- Filtro por situação --}}
                    <div class="col-md-3">
                        <label class="form-label" for="situacao">
                            <i class="bi bi-flag me-1"></i>Situação na Loja
                        </label>
                        <select id="situacao" name="situacao" class="form-select">
                            <option value="">— Todas as situações —</option>
                            @foreach ([
            'ativo' => 'Ativo',
            'inativo' => 'Inativo',
            'suspenso' => 'Suspenso',
            'remido' => 'Remido',
            'benemerito' => 'Benemérito',
            'fundador' => 'Fundador',
            'transferido' => 'Transferido',
            'falecido' => 'Falecido',
        ] as $val => $label)
                                <option value="{{ $val }}" {{ request('situacao') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filtro por grau --}}
                    <div class="col-md-2">
                        <label class="form-label" for="grau">
                            <i class="bi bi-award me-1"></i>Grau
                        </label>
                        <select id="grau" name="grau" class="form-select">
                            <option value="">— Todos —</option>
                            <option value="1" {{ request('grau') == '1' ? 'selected' : '' }}>1° Aprendiz</option>
                            <option value="2" {{ request('grau') == '2' ? 'selected' : '' }}>2° Companheiro</option>
                            <option value="3" {{ request('grau') == '3' ? 'selected' : '' }}>3° Mestre</option>
                        </select>
                    </div>

                    {{-- Botões do filtro --}}
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="bi bi-search me-1"></i>Filtrar
                            </button>
                            <a href="/admin/membros" class="btn btn-outline-secondary" title="Limpar todos os filtros">
                                <i class="bi bi-x-circle me-1"></i>Limpar
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
     TABELA DE MEMBROS
     ════════════════════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                {{-- Cabeçalho da tabela --}}
                <thead style="background:#1a3a5c">
                    <tr>
                        <th style="width:60px;padding:1rem .75rem"></th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">IRMÃO / NOME SIMBÓLICO</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">CIM</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">GRAU</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">CARGO ATUAL</th>
                        <th style="color:#fff;font-size:.85rem;padding:1rem .75rem">SITUAÇÃO</th>
                        <th style="width:170px;color:#c9a84c;font-size:.8rem;padding:1rem .75rem;text-align:center">AÇÕES
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($membros as $membro)
                        <tr style="font-size:1rem">

                            {{-- Foto ou avatar padrão --}}
                            <td style="padding:.85rem .75rem">
                                @if ($membro->foto)
                                    <img src="{{ asset('storage/' . $membro->foto) }}" class="rounded-circle border"
                                        style="width:46px;height:46px;object-fit:cover"
                                        alt="Foto de {{ $membro->nome_completo }}">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;background:#1a3a5c" title="Sem foto cadastrada">
                                        <i class="bi bi-person-fill text-white" style="font-size:1.2rem"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Nome completo — clicável para abrir o perfil --}}
                            <td style="padding:.85rem .75rem">
                                <a href="/admin/membros/{{ $membro->id }}" class="text-decoration-none fw-bold"
                                    style="color:#1a3a5c;font-size:1.05rem">
                                    {{ $membro->nome_completo }}
                                </a>

                                @if ($membro->nome_maconico)
                                    <div class="text-muted" style="font-size:.9rem">
                                        <i class="bi bi-pentagon me-1" style="font-size:.75rem"></i>
                                        {{ $membro->nome_maconico }}
                                    </div>
                                @endif
                            </td>

                            {{-- Número CIM --}}
                            <td style="padding:.85rem .75rem">
                                <span class="font-monospace fw-semibold" style="font-size:1rem;color:#2c5f8a">
                                    {{ $membro->cim ?? '—' }}
                                </span>
                            </td>

                            {{-- Badge do grau maçônico --}}
                            <td style="padding:.85rem .75rem">
                                @php
                                    $grauEstilos = [
                                        1 => ['bg' => '#ffc107', 'color' => '#333', 'label' => '1° Aprendiz'],
                                        2 => ['bg' => '#0dcaf0', 'color' => '#333', 'label' => '2° Companheiro'],
                                        3 => ['bg' => '#0d6efd', 'color' => '#fff', 'label' => '3° Mestre'],
                                    ];
                                    $grauEstilo = $grauEstilos[$membro->grau] ?? [
                                        'bg' => '#6c757d',
                                        'color' => '#fff',
                                        'label' => 'Grau ' . $membro->grau,
                                    ];
                                @endphp
                                <span class="badge"
                                    style="background:{{ $grauEstilo['bg'] }};color:{{ $grauEstilo['color'] }};font-size:.85rem;padding:.45em .75em">
                                    {{ $grauEstilo['label'] }}
                                </span>
                            </td>

                            {{-- Cargo atual --}}
                            <td style="padding:.85rem .75rem;color:#444">
                                {{ $membro->cargo_atual ?? '—' }}
                            </td>

                            {{-- Badge da situação --}}
                            <td style="padding:.85rem .75rem">
                                @php
                                    $situacaoEstilos = [
                                        'ativo' => ['bg' => '#198754', 'label' => '✓ Ativo'],
                                        'inativo' => ['bg' => '#6c757d', 'label' => 'Inativo'],
                                        'suspenso' => ['bg' => '#dc3545', 'label' => 'Suspenso'],
                                        'remido' => ['bg' => '#0dcaf0', 'label' => 'Remido'],
                                        'benemerito' => ['bg' => '#0d6efd', 'label' => 'Benemérito'],
                                        'fundador' => ['bg' => '#212529', 'label' => 'Fundador'],
                                        'transferido' => ['bg' => '#fd7e14', 'label' => 'Transferido'],
                                        'falecido' => ['bg' => '#343a40', 'label' => 'In Memoriam'],
                                    ];
                                    $sitEstilo = $situacaoEstilos[$membro->situacao] ?? [
                                        'bg' => '#6c757d',
                                        'label' => ucfirst($membro->situacao),
                                    ];
                                @endphp
                                <span class="badge"
                                    style="background:{{ $sitEstilo['bg'] }};color:#fff;font-size:.85rem;padding:.45em .75em">
                                    {{ $sitEstilo['label'] }}
                                </span>
                            </td>

                            {{-- Botões de ação --}}
                            <td style="padding:.85rem .75rem;text-align:center">
                                <div class="d-flex gap-1 justify-content-center">

                                    {{-- Ver perfil completo --}}

                                    <a href="/admin/membros/{{ $membro->id }}" class="btn btn-secondary btn-sm"
                                        title="Ver perfil completo do irmão" style="min-width:38px">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    {{-- Editar dados --}}

                                    <a href="/admin/membros/{{ $membro->id }}/edit" class="btn btn-primary btn-sm"
                                        title="Editar dados do irmão" style="min-width:38px">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    {{-- Arquivar (soft delete — dados são preservados) --}}
                                    <form method="POST" action="/admin/membros/{{ $membro->id }}" class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja arquivar o irmão {{ addslashes($membro->nome_completo) }}?\n\nOs dados serão preservados e poderão ser recuperados.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            title="Arquivar este irmão (não apaga os dados)" style="min-width:38px">
                                            <i class="bi bi-archive-fill"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty

                        {{-- Estado vazio --}}
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-people"
                                    style="font-size:3rem;color:#ccc;display:block;margin-bottom:.75rem"></i>
                                <p class="text-muted mb-3" style="font-size:1.1rem">
                                    @if (request('busca') || request('situacao') || request('grau'))
                                        Nenhum irmão encontrado com os filtros aplicados.
                                    @else
                                        Nenhum irmão cadastrado ainda.
                                    @endif
                                </p>
                                @if (request('busca') || request('situacao') || request('grau'))
                                    <a href="/admin/membros" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-x-circle me-1"></i>Limpar filtros
                                    </a>
                                @endif
                                <a href="/admin/membros/create" class="btn btn-lg"
                                    style="background:#7b1fa2;color:#fff;border:none">
                                    <i class="bi bi-person-plus-fill me-2"></i>Cadastrar primeiro irmão
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Rodapé com paginação --}}
        @if ($membros->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                    Exibindo {{ $membros->firstItem() }}–{{ $membros->lastItem() }}
                    de <strong>{{ $membros->total() }}</strong> irmãos
                </small>
                <div>{{ $membros->links() }}</div>
            </div>
        @endif
    </div>
@endsection
