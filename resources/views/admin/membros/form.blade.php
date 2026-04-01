{{--
    ============================================================
    View: admin/membros/form.blade.php
    Descrição: Formulário de cadastro e edição de Irmão Maçom
    Público-alvo: usuários 45+ — botões grandes, instruções claras
    ============================================================
--}}
@extends('admin.layouts.app')

@section('content')

@php $editando = isset($membro); @endphp

{{-- ── Cabeçalho ── --}}
<div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
    <div>
        <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
            <i class="bi bi-{{ $editando ? 'pencil-square' : 'person-plus-fill' }} me-2" style="color:#c9a84c"></i>
            {{ $editando ? 'Editar Dados do Irmão' : 'Cadastrar Novo Irmão' }}
        </h3>
        <p class="text-muted mb-0">
            {{ $editando ? $membro->nome_completo : 'Preencha os campos e clique em Cadastrar Irmão ao final' }}
        </p>
    </div>
    <div class="d-flex gap-2">
        {{-- Botão de ajuda --}}
        <button
            type="button"
            class="btn btn-outline-secondary"
            data-bs-toggle="modal"
            data-bs-target="#modal-ajuda-form"
        >
            <i class="bi bi-question-circle-fill me-1"></i>Ajuda
        </button>
        {{-- Voltar --}}
        <a href="/admin/membros" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Voltar
        </a>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════
     MODAL DE AJUDA DO FORMULÁRIO
     ════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="modal-ajuda-form" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header" style="background:#1a3a5c">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-question-circle-fill me-2" style="color:#c9a84c"></i>
                    Como preencher este formulário
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="font-size:1.05rem">
                <p>O formulário está dividido em <strong>4 abas</strong>. Clique em cada aba para ver e preencher os campos.</p>
                <ul class="mb-3" style="line-height:2">
                    <li><i class="bi bi-pentagon me-1 text-primary"></i><strong>Dados Maçônicos</strong> — CIM, grau, cargo, situação e datas na Maçonaria</li>
                    <li><i class="bi bi-person me-1 text-primary"></i><strong>Dados Pessoais</strong> — documentos, nascimento, foto e profissão</li>
                    <li><i class="bi bi-telephone me-1 text-primary"></i><strong>Contato</strong> — e-mail, telefone e WhatsApp</li>
                    <li><i class="bi bi-geo-alt me-1 text-primary"></i><strong>Endereço</strong> — CEP com busca automática</li>
                </ul>
                <div class="alert mb-0" style="background:#fff3cd;border-left:4px solid #ffc107">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="color:#856404"></i>
                    Os campos marcados com <span class="text-danger fw-bold">*</span> são obrigatórios.
                    Somente o <strong>Nome Completo</strong>, <strong>Grau</strong> e <strong>Situação</strong> precisam ser preenchidos obrigatoriamente.
                    Os demais campos podem ser preenchidos depois.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-lg" data-bs-dismiss="modal">
                    <i class="bi bi-check-lg me-1"></i>Entendido!
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Alerta de erros de validação --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Corrija os erros antes de salvar:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ── Formulário ── --}}
<form
    method="POST"
    action="{{ $editando ? '/admin/membros/' . $membro->id : '/admin/membros' }}"
    enctype="multipart/form-data"
    id="form-membro"
    novalidate
>
    @csrf
    @if($editando) @method('PUT') @endif

    {{-- ── Abas de navegação com estilo destacado ── --}}
    <ul class="nav nav-tabs mb-0" id="abas-membro" role="tablist" style="font-size:1rem">

        <li class="nav-item" role="presentation">
            <a class="nav-link active fw-semibold" id="tab-maconico" data-bs-toggle="tab"
               href="#aba-maconico" role="tab" aria-selected="true">
                <i class="bi bi-pentagon-fill me-2" style="color:#c9a84c"></i>
                Dados Maçônicos
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-semibold" id="tab-pessoal" data-bs-toggle="tab"
               href="#aba-pessoal" role="tab" aria-selected="false">
                <i class="bi bi-person-fill me-2 text-primary"></i>
                Dados Pessoais
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-semibold" id="tab-contato" data-bs-toggle="tab"
               href="#aba-contato" role="tab" aria-selected="false">
                <i class="bi bi-telephone-fill me-2 text-success"></i>
                Contato
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-semibold" id="tab-endereco" data-bs-toggle="tab"
               href="#aba-endereco" role="tab" aria-selected="false">
                <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                Endereço
            </a>
        </li>

    </ul>

    {{-- ── Conteúdo das abas ── --}}
    <div class="tab-content border border-top-0 rounded-bottom mb-4" style="background:#fff">

        {{-- ABA 1: Dados Maçônicos --}}
        <div class="tab-pane fade show active p-4" id="aba-maconico" role="tabpanel">
            <p class="text-muted mb-4" style="font-size:.95rem;border-left:4px solid #c9a84c;padding-left:.75rem">
                Informações maçônicas do irmão: número de cadastro, grau, cargo e datas importantes na sua trajetória.
            </p>
            <div class="row g-3">

                <div class="col-md-3">
                    <label class="form-label" for="cim">
                        CIM
                        <small class="text-muted">(Cadastro de Irmão Maçom)</small>
                    </label>
                    <input type="text" id="cim" name="cim"
                        class="form-control @error('cim') is-invalid @enderror"
                        value="{{ old('cim', $membro->cim ?? '') }}"
                        placeholder="Ex: 519328">
                    @error('cim')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-9">
                    <label class="form-label" for="nome_completo">
                        Nome Completo <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="nome_completo" name="nome_completo"
                        class="form-control @error('nome_completo') is-invalid @enderror"
                        value="{{ old('nome_completo', $membro->nome_completo ?? '') }}"
                        placeholder="Nome completo do irmão" required>
                    @error('nome_completo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="nome_maconico">Nome Simbólico</label>
                    <input type="text" id="nome_maconico" name="nome_maconico"
                        class="form-control"
                        value="{{ old('nome_maconico', $membro->nome_maconico ?? '') }}"
                        placeholder="Nome simbólico na loja">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="grau">
                        Grau <span class="text-danger">*</span>
                    </label>
                    <select id="grau" name="grau"
                        class="form-select @error('grau') is-invalid @enderror" required>
                        <option value="1" {{ old('grau', $membro->grau ?? 1) == 1 ? 'selected' : '' }}>1° Aprendiz</option>
                        <option value="2" {{ old('grau', $membro->grau ?? '') == 2 ? 'selected' : '' }}>2° Companheiro</option>
                        <option value="3" {{ old('grau', $membro->grau ?? '') == 3 ? 'selected' : '' }}>3° Mestre</option>
                    </select>
                    @error('grau')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="cargo_atual">Cargo Atual</label>
                    <select id="cargo_atual" name="cargo_atual" class="form-select">
                        <option value="">— Sem cargo —</option>
                        @foreach(['Venerável Mestre','Primeiro Vigilante','Segundo Vigilante','Orador','Secretário','Tesoureiro','Chanceler','Mestre de Cerimônias','Hospitaleiro','Arquiteto','Porta-Estandarte','Primeiro Diácono','Segundo Diácono','Cobridor Interno','Cobridor Externo'] as $cargo)
                            <option value="{{ $cargo }}" {{ old('cargo_atual', $membro->cargo_atual ?? '') === $cargo ? 'selected' : '' }}>
                                {{ $cargo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="situacao">
                        Situação <span class="text-danger">*</span>
                    </label>
                    <select id="situacao" name="situacao"
                        class="form-select @error('situacao') is-invalid @enderror" required>
                        @foreach(['ativo'=>'Ativo','inativo'=>'Inativo','suspenso'=>'Suspenso','remido'=>'Remido','benemerito'=>'Benemérito','fundador'=>'Fundador','transferido'=>'Transferido','falecido'=>'Falecido'] as $val => $label)
                            <option value="{{ $val }}" {{ old('situacao', $membro->situacao ?? 'ativo') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('situacao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="tipo_membro">Tipo de Membro</label>
                    <select id="tipo_membro" name="tipo_membro" class="form-select">
                        @foreach(['efetivo'=>'Efetivo','honorario'=>'Honorário','correspondente'=>'Correspondente'] as $val => $label)
                            <option value="{{ $val }}" {{ old('tipo_membro', $membro->tipo_membro ?? 'efetivo') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted" style="font-size:.9rem">
                        <i class="bi bi-calendar3 me-1"></i>Datas da Trajetória Maçônica
                    </label>
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="data_iniciacao">Data de Iniciação</label>
                    <input type="date" id="data_iniciacao" name="data_iniciacao" class="form-control"
                        value="{{ old('data_iniciacao', isset($membro->data_iniciacao) ? $membro->data_iniciacao->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_elevacao">Data de Elevação</label>
                    <input type="date" id="data_elevacao" name="data_elevacao" class="form-control"
                        value="{{ old('data_elevacao', isset($membro->data_elevacao) ? $membro->data_elevacao->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_exaltacao">Data de Exaltação</label>
                    <input type="date" id="data_exaltacao" name="data_exaltacao" class="form-control"
                        value="{{ old('data_exaltacao', isset($membro->data_exaltacao) ? $membro->data_exaltacao->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_filiacao_loja">Filiação nesta Loja</label>
                    <input type="date" id="data_filiacao_loja" name="data_filiacao_loja" class="form-control"
                        value="{{ old('data_filiacao_loja', isset($membro->data_filiacao_loja) ? $membro->data_filiacao_loja->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="loja_origem">
                        Loja de Origem
                        <small class="text-muted">(somente se transferido)</small>
                    </label>
                    <input type="text" id="loja_origem" name="loja_origem" class="form-control"
                        value="{{ old('loja_origem', $membro->loja_origem ?? '') }}"
                        placeholder="Nome da loja de origem">
                </div>

            </div>
        </div>

        {{-- ABA 2: Dados Pessoais --}}
        <div class="tab-pane fade p-4" id="aba-pessoal" role="tabpanel">
            <p class="text-muted mb-4" style="font-size:.95rem;border-left:4px solid #0d6efd;padding-left:.75rem">
                Dados civis e documentos pessoais do irmão. A data de nascimento é usada para envio automático de felicitações de aniversário.
            </p>
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label" for="nome_civil">Nome Civil <small class="text-muted">(conforme RG)</small></label>
                    <input type="text" id="nome_civil" name="nome_civil" class="form-control"
                        value="{{ old('nome_civil', $membro->nome_civil ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento', isset($membro->data_nascimento) ? $membro->data_nascimento->format('Y-m-d') : '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="estado_civil">Estado Civil</label>
                    <select id="estado_civil" name="estado_civil" class="form-select">
                        <option value="">— Selecione —</option>
                        @foreach(['solteiro'=>'Solteiro','casado'=>'Casado','divorciado'=>'Divorciado','viuvo'=>'Viúvo','uniao_estavel'=>'União Estável'] as $val => $label)
                            <option value="{{ $val }}" {{ old('estado_civil', $membro->estado_civil ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf"
                        class="form-control @error('cpf') is-invalid @enderror"
                        value="{{ old('cpf', $membro->cpf ?? '') }}"
                        placeholder="000.000.000-00" maxlength="14">
                    @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="rg">RG</label>
                    <input type="text" id="rg" name="rg" class="form-control"
                        value="{{ old('rg', $membro->rg ?? '') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="orgao_expedidor">Órgão Expedidor</label>
                    <input type="text" id="orgao_expedidor" name="orgao_expedidor" class="form-control"
                        value="{{ old('orgao_expedidor', $membro->orgao_expedidor ?? '') }}"
                        placeholder="SSP-SP" maxlength="20">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="titulo_eleitor">Título de Eleitor</label>
                    <input type="text" id="titulo_eleitor" name="titulo_eleitor" class="form-control"
                        value="{{ old('titulo_eleitor', $membro->titulo_eleitor ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="profissao">Profissão</label>
                    <input type="text" id="profissao" name="profissao" class="form-control"
                        value="{{ old('profissao', $membro->profissao ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="escolaridade">Escolaridade</label>
                    <select id="escolaridade" name="escolaridade" class="form-select">
                        <option value="">— Selecione —</option>
                        @foreach(['Ensino Fundamental','Ensino Médio','Ensino Técnico','Ensino Superior','Pós-Graduação','Mestrado','Doutorado'] as $esc)
                            <option value="{{ $esc }}" {{ old('escolaridade', $membro->escolaridade ?? '') === $esc ? 'selected' : '' }}>{{ $esc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="naturalidade">Naturalidade</label>
                    <input type="text" id="naturalidade" name="naturalidade" class="form-control"
                        value="{{ old('naturalidade', $membro->naturalidade ?? '') }}"
                        placeholder="Cidade onde nasceu">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="nacionalidade">Nacionalidade</label>
                    <input type="text" id="nacionalidade" name="nacionalidade" class="form-control"
                        value="{{ old('nacionalidade', $membro->nacionalidade ?? 'Brasileiro') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Foto do Irmão</label>
                    <div class="d-flex align-items-center gap-3">
                        @if($editando && $membro->foto)
                            <img src="{{ asset('storage/' . $membro->foto) }}"
                                class="rounded-circle border shadow-sm"
                                style="width:72px;height:72px;object-fit:cover"
                                alt="Foto atual" title="Foto atual — envie uma nova para substituir">
                        @endif
                        <div>
                            <input type="file" id="foto" name="foto"
                                class="form-control @error('foto') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/webp"
                                style="max-width:400px">
                            <div class="form-text">Formatos: JPG, PNG, WEBP. Tamanho máximo: 2MB.</div>
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label" for="observacoes">Observações internas</label>
                    <textarea id="observacoes" name="observacoes" class="form-control" rows="3"
                        placeholder="Anotações internas (não exibidas publicamente)">{{ old('observacoes', $membro->observacoes ?? '') }}</textarea>
                </div>
                <div class="col-12">
                    <div class="form-check form-check-lg">
                        <input type="checkbox" id="recebe_email" name="recebe_email"
                            class="form-check-input"
                            {{ old('recebe_email', $membro->recebe_email ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="recebe_email" style="font-size:1rem">
                            <strong>Recebe e-mails do sistema</strong>
                            <small class="text-muted d-block">Felicitações de aniversário, comunicados da loja</small>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        {{-- ABA 3: Contato --}}
        <div class="tab-pane fade p-4" id="aba-contato" role="tabpanel">
            <p class="text-muted mb-4" style="font-size:.95rem;border-left:4px solid #198754;padding-left:.75rem">
                Informações de contato do irmão. O e-mail principal será usado para comunicações oficiais da loja.
            </p>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label" for="email">E-mail Principal</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $membro->email ?? '') }}"
                        placeholder="email@exemplo.com.br">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="email_alternativo">E-mail Alternativo</label>
                    <input type="email" id="email_alternativo" name="email_alternativo"
                        class="form-control"
                        value="{{ old('email_alternativo', $membro->email_alternativo ?? '') }}"
                        placeholder="outro@exemplo.com.br">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="telefone">Telefone Fixo</label>
                    <input type="text" id="telefone" name="telefone" class="form-control"
                        value="{{ old('telefone', $membro->telefone ?? '') }}"
                        placeholder="(11) 0000-0000" maxlength="20">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="celular">Celular</label>
                    <input type="text" id="celular" name="celular" class="form-control"
                        value="{{ old('celular', $membro->celular ?? '') }}"
                        placeholder="(11) 00000-0000" maxlength="20">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="whatsapp">
                        <i class="bi bi-whatsapp text-success me-1"></i>WhatsApp
                    </label>
                    <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                        value="{{ old('whatsapp', $membro->whatsapp ?? '') }}"
                        placeholder="(11) 00000-0000" maxlength="20">
                </div>
            </div>
        </div>

        {{-- ABA 4: Endereço --}}
        <div class="tab-pane fade p-4" id="aba-endereco" role="tabpanel">
            <p class="text-muted mb-4" style="font-size:.95rem;border-left:4px solid #dc3545;padding-left:.75rem">
                Endereço residencial do irmão. Digite o CEP e clique na lupa para preencher automaticamente.
            </p>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label" for="cep">CEP</label>
                    <div class="input-group">
                        <input type="text" id="cep" name="cep" class="form-control"
                            value="{{ old('cep', $membro->cep ?? '') }}"
                            placeholder="00000-000" maxlength="10">
                        <button type="button" class="btn btn-primary" onclick="buscarCep()" title="Buscar endereço">
                            <i class="bi bi-search me-1"></i>Buscar
                        </button>
                    </div>
                    <div class="form-text">Digite o CEP e clique em Buscar ou pressione Enter.</div>
                </div>
                <div class="col-md-7">
                    <label class="form-label" for="logradouro">Logradouro</label>
                    <input type="text" id="logradouro" name="logradouro" class="form-control"
                        value="{{ old('logradouro', $membro->logradouro ?? '') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="numero">Número</label>
                    <input type="text" id="numero" name="numero" class="form-control"
                        value="{{ old('numero', $membro->numero ?? '') }}" maxlength="10">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="complemento">Complemento</label>
                    <input type="text" id="complemento" name="complemento" class="form-control"
                        value="{{ old('complemento', $membro->complemento ?? '') }}"
                        placeholder="Apto, Bloco, Casa...">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" class="form-control"
                        value="{{ old('bairro', $membro->bairro ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-control"
                        value="{{ old('cidade', $membro->cidade ?? '') }}">
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="estado">UF</label>
                    <input type="text" id="estado" name="estado" class="form-control text-uppercase"
                        value="{{ old('estado', $membro->estado ?? '') }}"
                        maxlength="2" placeholder="SP">
                </div>
            </div>
        </div>

    </div>{{-- fim tab-content --}}

    {{-- ── Barra de ação fixa ao fundo — botões grandes e coloridos ── --}}
    <div class="d-flex flex-wrap gap-3 align-items-center p-3 rounded" style="background:#f8f9fa;border:1px solid #dee2e6">
        <button type="submit" class="btn btn-lg" style="background:#1a7a4a;color:#fff;border:none;min-width:220px">
            <i class="bi bi-{{ $editando ? 'check-circle-fill' : 'person-plus-fill' }} me-2"></i>
            {{ $editando ? 'Salvar Alterações' : 'Cadastrar Irmão' }}
        </button>
        <a href="/admin/membros" class="btn btn-lg btn-outline-secondary">
            <i class="bi bi-x-circle me-2"></i>Cancelar
        </a>
        <small class="text-muted ms-auto">
            <i class="bi bi-info-circle me-1"></i>
            Os campos com <span class="text-danger fw-bold">*</span> são obrigatórios
        </small>
    </div>

</form>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Mapa de campos por aba para reabrir a aba com erro
        const mapaAbaCampos = {
            'aba-maconico': ['cim', 'nome_completo', 'grau', 'situacao'],
            'aba-pessoal' : ['nome_civil', 'cpf', 'foto', 'data_nascimento'],
            'aba-contato' : ['email', 'email_alternativo'],
            'aba-endereco': ['cep', 'logradouro'],
        };

        for (const [abaId, campos] of Object.entries(mapaAbaCampos)) {
            const temErro = campos.some(function (nome) {
                const el = document.querySelector('[name="' + nome + '"]');
                return el && el.classList.contains('is-invalid');
            });
            if (temErro) {
                const linkAba = document.querySelector('a[href="#' + abaId + '"]');
                if (linkAba) new bootstrap.Tab(linkAba).show();
                break;
            }
        }

        // Busca de CEP via ViaCEP
        async function buscarCep() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length !== 8) { alert('Digite um CEP válido com 8 dígitos.'); return; }
            try {
                const r = await fetch('https://viacep.com.br/ws/' + cep + '/json/');
                const d = await r.json();
                if (d.erro) { alert('CEP não encontrado.'); return; }
                document.getElementById('logradouro').value  = d.logradouro  || '';
                document.getElementById('bairro').value      = d.bairro      || '';
                document.getElementById('cidade').value      = d.localidade  || '';
                document.getElementById('estado').value      = d.uf          || '';
                document.getElementById('complemento').value = d.complemento || '';
                document.getElementById('numero').focus();
            } catch { alert('Erro ao buscar CEP. Verifique sua conexão.'); }
        }

        window.buscarCep = buscarCep;

        const campoCep = document.getElementById('cep');
        if (campoCep) {
            campoCep.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') { e.preventDefault(); buscarCep(); }
            });
        }
    });
</script>
@endpush