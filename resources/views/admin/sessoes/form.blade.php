{{--
    View: admin/sessoes/form.blade.php
    Descrição: Formulário de criação e edição de sessão da loja
--}}
@extends('admin.layouts.app')

@section('content')

    @php $editando = isset($sessao); @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-calendar-plus me-2" style="color:#c9a84c"></i>
                {{ $editando ? 'Editar Sessão' : 'Nova Sessão da Loja' }}
            </h3>
            <p class="text-muted mb-0">
                {{ $editando ? $sessao->nome : 'Preencha os dados da sessão agendada' }}
            </p>
        </div>
        <a href="{{ route('sessoes.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Voltar
        </a>
    </div>

    {{-- Erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Corrija os erros:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ $editando ? route('sessoes.update', $sessao) : route('sessoes.store') }}">
        @csrf
        @if ($editando)
            @method('PUT')
        @endif

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold" style="border-bottom:2px solid #c9a84c">
                <i class="bi bi-pentagon-fill me-2" style="color:#c9a84c"></i>
                Dados da Sessão
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Nome da sessão --}}
                    <div class="col-md-8">
                        <label class="form-label" for="nome">
                            Nome da Sessão <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="nome" name="nome"
                            class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome', $sessao->nome ?? '') }}"
                            placeholder="Ex: Sessão Grau 1 — Finanças da Loja" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Descreva brevemente o tema ou pauta da sessão.</div>
                    </div>

                    {{-- Grau --}}
                    <div class="col-md-4">
                        <label class="form-label" for="grau">
                            Grau da Sessão <span class="text-danger">*</span>
                        </label>
                        <select id="grau" name="grau" class="form-select @error('grau') is-invalid @enderror"
                            required>
                            @foreach ([
            1 => '1° Grau — Aprendiz',
            2 => '2° Grau — Companheiro',
            3 => '3° Grau — Mestre',
        ] as $val => $label)
                                <option value="{{ $val }}"
                                    {{ old('grau', $sessao->grau ?? 1) == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('grau')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Data --}}
                    <div class="col-md-3">
                        <label class="form-label" for="data">
                            Data da Sessão <span class="text-danger">*</span>
                        </label>
                        <input type="date" id="data" name="data"
                            class="form-control @error('data') is-invalid @enderror"
                            value="{{ old('data', isset($sessao->data) ? $sessao->data->format('Y-m-d') : '') }}" required>
                        @error('data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text" id="dia-semana-label" style="color:#1a3a5c;font-weight:600"></div>
                    </div>

                    {{-- Horário de início --}}
                    <div class="col-md-3">
                        <label class="form-label" for="horario_inicio">
                            Horário de Início <span class="text-danger">*</span>
                        </label>
                        <input type="time" id="horario_inicio" name="horario_inicio"
                            class="form-control @error('horario_inicio') is-invalid @enderror"
                            value="{{ old('horario_inicio', isset($sessao->horario_inicio) ? \Carbon\Carbon::createFromFormat('H:i:s', $sessao->horario_inicio)->format('H:i') : '20:00') }}"
                            required>
                        @error('horario_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Horário de encerramento --}}
                    <div class="col-md-3">
                        <label class="form-label" for="horario_encerramento">
                            Horário de Encerramento
                            <small class="text-muted">(previsto)</small>
                        </label>
                        <input type="time" id="horario_encerramento" name="horario_encerramento" class="form-control"
                            value="{{ old('horario_encerramento', isset($sessao->horario_encerramento) ? \Carbon\Carbon::createFromFormat('H:i:s', $sessao->horario_encerramento)->format('H:i') : '') }}">
                    </div>

                    {{-- Rito --}}
                    <div class="col-md-3">
                        <label class="form-label" for="rito">
                            Rito <span class="text-danger">*</span>
                        </label>
                        <select id="rito" name="rito" class="form-select @error('rito') is-invalid @enderror"
                            required>
                            @foreach (['Rito Escocês Antigo e Aceito', 'Rito York', 'Rito Brasileiro', 'Rito de Schröder', 'Rito Moderno'] as $r)
                                <option value="{{ $r }}"
                                    {{ old('rito', $sessao->rito ?? 'Rito Escocês Antigo e Aceito') === $r ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                        @error('rito')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Observações --}}
                    <div class="col-12">
                        <label class="form-label" for="observacoes">Observações</label>
                        <textarea id="observacoes" name="observacoes" class="form-control" rows="3"
                            placeholder="Informações adicionais, pauta, convidados especiais, etc.">{{ old('observacoes', $sessao->observacoes ?? '') }}</textarea>
                    </div>

                    {{-- Publicado --}}
                    <div class="col-12">
                        <div class="form-check form-check-lg">
                            <input type="checkbox" id="publicado" name="publicado" class="form-check-input"
                                {{ old('publicado', $sessao->publicado ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="publicado" style="font-size:1rem">
                                <strong>Exibir na página inicial do site</strong>
                                <small class="text-muted d-block">
                                    Quando marcado, esta sessão aparece no calendário público da home
                                </small>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Card: Localização --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold" style="border-bottom:2px solid #198754">
                <i class="bi bi-geo-alt-fill me-2 text-success"></i>
                Local da Sessão
            </div>
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <p class="mb-1 fw-bold" style="color:#1a3a5c">
                            <i class="bi bi-building me-2"></i>
                            Templo Antônio Latuf Cury
                        </p>
                        <p class="mb-0 text-muted">
                            R. Jorn. Sebastião Souza Lemos, 240 — Jardim Pérola<br>
                            Ferraz de Vasconcelos — SP, CEP 08544-400
                        </p>
                    </div>
                    <div class="col-md-4 d-flex gap-2 flex-wrap">
                        <a href="https://maps.app.goo.gl/TpZyhLZBMjS9s9Pi9" target="_blank" class="btn btn-success">
                            <i class="bi bi-map-fill me-1"></i>Google Maps
                        </a>
                        <a href="https://waze.com/ul?ll=-23.5396,-46.3687&navigate=yes" target="_blank"
                            class="btn btn-outline-primary">
                            <i class="bi bi-navigation-fill me-1"></i>Waze
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botões --}}
        <div class="d-flex flex-wrap gap-3 align-items-center p-3 rounded"
            style="background:#f8f9fa;border:1px solid #dee2e6">
            <button type="submit" class="btn btn-lg" style="background:#1a7a4a;color:#fff;border:none;min-width:200px">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ $editando ? 'Salvar Alterações' : 'Cadastrar Sessão' }}
            </button>
            <a href="{{ route('sessoes.index') }}" class="btn btn-lg btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Cancelar
            </a>
        </div>

    </form>

@endsection

@push('scripts')
    <script>
        // Exibe o dia da semana ao selecionar a data
        const inputData = document.getElementById('data');
        const labelDia = document.getElementById('dia-semana-label');

        const diasPt = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

        function atualizarDiaSemana() {
            if (!inputData.value) {
                labelDia.textContent = '';
                return;
            }
            // Adiciona T00:00 para evitar problema de fuso
            const d = new Date(inputData.value + 'T00:00');
            labelDia.textContent = '📅 ' + diasPt[d.getDay()];
        }

        inputData.addEventListener('change', atualizarDiaSemana);
        atualizarDiaSemana(); // Executa ao carregar (modo edição)
    </script>
@endpush
