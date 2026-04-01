{{--
    View: admin/eventos/form.blade.php
    Descrição: Formulário de criação e edição de evento da loja
    Editor: CKEditor 5 (mesmo padrão do form de notícias)
--}}
@extends('admin.layouts.app')

@section('content')

    @php $editando = isset($evento); @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="mb-1 fw-bold" style="color:#1a3a5c">
                <i class="bi bi-calendar-plus me-2" style="color:#c9a84c"></i>
                {{ $editando ? 'Editar Evento' : 'Novo Evento da Loja' }}
            </h3>
            <p class="text-muted mb-0">
                {{ $editando ? $evento->titulo : 'Preencha os dados do evento' }}
            </p>
        </div>
        <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Voltar
        </a>
    </div>

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

    <form method="POST" action="{{ $editando ? route('eventos.update', $evento) : route('eventos.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($editando)
            @method('PUT')
        @endif

        {{-- ── Card: Informações principais ── --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold" style="border-bottom:2px solid #c9a84c">
                <i class="bi bi-calendar-event-fill me-2" style="color:#c9a84c"></i>
                Informações do Evento
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Título --}}
                    <div class="col-md-8">
                        <label class="form-label" for="titulo">
                            Título do Evento <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="titulo" name="titulo"
                            class="form-control @error('titulo') is-invalid @enderror"
                            value="{{ old('titulo', $evento->titulo ?? '') }}"
                            placeholder="Ex: 36° Aniversário da ARLS Ferraz de Vasconcelos" required>
                        @error('titulo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tipo --}}
                    <div class="col-md-4">
                        <label class="form-label" for="tipo">
                            Tipo do Evento <span class="text-danger">*</span>
                        </label>
                        <select id="tipo" name="tipo" class="form-select @error('tipo') is-invalid @enderror"
                            required>
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
                                <option value="{{ $val }}"
                                    {{ old('tipo', $evento->tipo ?? 'geral') === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Descrição curta (resumo para o card da home) --}}
                    <div class="col-12">
                        <label class="form-label" for="descricao">
                            Descrição Curta
                            <small class="text-muted">— aparece no card da página inicial</small>
                        </label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="3"
                            placeholder="Breve descrição para o card: o que é o evento, para quem é, destaque principal...">{{ old('descricao', $evento->descricao ?? '') }}</textarea>
                    </div>

                    {{-- Conteúdo completo — CKEditor ── --}}
                    <div class="col-12">
                        <label class="form-label" for="editor-conteudo">
                            <i class="bi bi-file-richtext me-1"></i>
                            Conteúdo Completo da Página do Evento
                            <small class="text-muted">— aparece ao clicar em "Ver detalhes"</small>
                        </label>

                        {{--
                        O textarea recebe id="editor-conteudo" para o CKEditor se vincular.
                        O name="conteudo" garante o envio correto ao controller.
                    --}}
                        <textarea id="editor-conteudo" name="conteudo">{{ old('conteudo', $evento->conteudo ?? '') }}</textarea>

                        <div class="form-text mt-2">
                            <i class="bi bi-lightbulb me-1 text-warning"></i>
                            Use este campo para descrever o evento em detalhes: programação completa,
                            como adquirir convites, dress code, estacionamento, atrações, palestrantes, etc.
                        </div>
                    </div>

                    {{-- Foto de capa --}}
                    <div class="col-12">
                        <label class="form-label">Foto de Capa</label>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            @if ($editando && $evento->foto_capa)
                                <img src="{{ asset('storage/' . $evento->foto_capa) }}"
                                    style="height:80px;border-radius:8px;object-fit:cover;border:2px solid #dee2e6"
                                    alt="Foto atual do evento">
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Envie uma nova imagem para substituir a atual.
                                </p>
                            @endif
                            <div>
                                <input type="file" id="foto_capa" name="foto_capa"
                                    class="form-control @error('foto_capa') is-invalid @enderror"
                                    accept="image/jpeg,image/png,image/webp" style="max-width:400px">
                                <div class="form-text">Formatos aceitos: JPG, PNG, WEBP. Tamanho máximo: 4MB.</div>
                                @error('foto_capa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Card: Data e horário ── --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold" style="border-bottom:2px solid #1a3a5c">
                <i class="bi bi-clock-fill me-2" style="color:#1a3a5c"></i>
                Data e Horário
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Data início --}}
                    <div class="col-md-3">
                        <label class="form-label" for="data_inicio">
                            Data de Início <span class="text-danger">*</span>
                        </label>
                        <input type="date" id="data_inicio" name="data_inicio"
                            class="form-control @error('data_inicio') is-invalid @enderror"
                            value="{{ old('data_inicio', isset($evento->data_inicio) ? $evento->data_inicio->format('Y-m-d') : '') }}"
                            required>
                        {{-- JS preenche o dia da semana aqui --}}
                        <div class="form-text fw-bold" id="dia-semana-label" style="color:#1a3a5c"></div>
                        @error('data_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Data fim --}}
                    <div class="col-md-3">
                        <label class="form-label" for="data_fim">
                            Data de Fim
                            <small class="text-muted">(deixe vazio se for um dia só)</small>
                        </label>
                        <input type="date" id="data_fim" name="data_fim"
                            class="form-control @error('data_fim') is-invalid @enderror"
                            value="{{ old('data_fim', isset($evento->data_fim) ? $evento->data_fim->format('Y-m-d') : '') }}">
                        @error('data_fim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Horário de início --}}
                    <div class="col-md-3">
                        <label class="form-label" for="horario_inicio">Horário de Início</label>
                        <input type="time" id="horario_inicio" name="horario_inicio" class="form-control"
                            value="{{ old('horario_inicio', isset($evento->horario_inicio) ? \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_inicio)->format('H:i') : '') }}">
                    </div>

                    {{-- Horário de encerramento --}}
                    <div class="col-md-3">
                        <label class="form-label" for="horario_encerramento">
                            Horário de Encerramento
                            <small class="text-muted">(previsto)</small>
                        </label>
                        <input type="time" id="horario_encerramento" name="horario_encerramento" class="form-control"
                            value="{{ old('horario_encerramento', isset($evento->horario_encerramento) ? \Carbon\Carbon::createFromFormat('H:i:s', $evento->horario_encerramento)->format('H:i') : '') }}">
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Card: Local ── --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold" style="border-bottom:2px solid #198754">
                <i class="bi bi-geo-alt-fill me-2 text-success"></i>
                Local do Evento
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Nome do local --}}
                    <div class="col-md-5">
                        <label class="form-label" for="local_nome">Nome do Local</label>
                        <input type="text" id="local_nome" name="local_nome" class="form-control"
                            value="{{ old('local_nome', $evento->local_nome ?? 'Templo Antônio Latuf Cury') }}"
                            placeholder="Ex: Templo Antônio Latuf Cury">
                    </div>

                    {{-- Endereço --}}
                    <div class="col-md-7">
                        <label class="form-label" for="local_endereco">Endereço Completo</label>
                        <input type="text" id="local_endereco" name="local_endereco" class="form-control"
                            value="{{ old('local_endereco', $evento->local_endereco ?? 'R. Jorn. Sebastião Souza Lemos, 240 - Jardim Pérola, Ferraz de Vasconcelos - SP, 08544-400') }}"
                            placeholder="Rua, número, bairro, cidade - UF">
                    </div>

                    {{-- Link Google Maps --}}
                    <div class="col-md-6">
                        <label class="form-label" for="link_maps">
                            <i class="bi bi-map-fill me-1" style="color:#4285f4"></i>
                            Link Google Maps
                        </label>
                        <input type="url" id="link_maps" name="link_maps"
                            class="form-control @error('link_maps') is-invalid @enderror"
                            value="{{ old('link_maps', $evento->link_maps ?? 'https://maps.app.goo.gl/TpZyhLZBMjS9s9Pi9') }}"
                            placeholder="https://maps.app.goo.gl/...">
                        @error('link_maps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Link Waze --}}
                    <div class="col-md-6">
                        <label class="form-label" for="link_waze">
                            <i class="bi bi-navigation-fill me-1" style="color:#33ccff"></i>
                            Link Waze
                        </label>
                        <input type="url" id="link_waze" name="link_waze"
                            class="form-control @error('link_waze') is-invalid @enderror"
                            value="{{ old('link_waze', $evento->link_waze ?? 'https://waze.com/ul?q=R.+Jorn.+Sebasti%C3%A3o+Souza+Lemos+240+Ferraz+de+Vasconcelos+SP&navigate=yes') }}"
                            placeholder="https://waze.com/ul?...">
                        @error('link_waze')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Card: Opções de publicação ── --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold" style="border-bottom:2px solid #6c757d">
                <i class="bi bi-sliders me-2 text-secondary"></i>
                Opções de Publicação
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    {{-- Link de inscrição --}}
                    <div class="col-md-6">
                        <label class="form-label" for="link_inscricao">
                            Link de Inscrição
                            <small class="text-muted">(opcional)</small>
                        </label>
                        <input type="url" id="link_inscricao" name="link_inscricao"
                            class="form-control @error('link_inscricao') is-invalid @enderror"
                            value="{{ old('link_inscricao', $evento->link_inscricao ?? '') }}"
                            placeholder="https://forms.google.com/...">
                        <div class="form-text">
                            Use quando o evento exigir inscrição ou aquisição de convite.
                        </div>
                        @error('link_inscricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Checkboxes --}}
                    <div class="col-md-6 d-flex flex-column justify-content-end gap-3">

                        <div class="form-check form-check-lg">
                            <input type="checkbox" id="publicado" name="publicado" class="form-check-input"
                                {{ old('publicado', $evento->publicado ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="publicado" style="font-size:1rem">
                                <strong>Publicar no site</strong>
                                <small class="text-muted d-block">Exibe o evento na página inicial</small>
                            </label>
                        </div>

                        <div class="form-check form-check-lg">
                            <input type="checkbox" id="destaque" name="destaque" class="form-check-input"
                                {{ old('destaque', $evento->destaque ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="destaque" style="font-size:1rem">
                                <strong>&#9733; Destacar na home</strong>
                                <small class="text-muted d-block">Aparece em posição privilegiada</small>
                            </label>
                        </div>

                        <div class="form-check form-check-lg">
                            <input type="checkbox" id="aberto_publico" name="aberto_publico" class="form-check-input"
                                {{ old('aberto_publico', $evento->aberto_publico ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="aberto_publico" style="font-size:1rem">
                                <strong>Aberto ao público geral</strong>
                                <small class="text-muted d-block">Não restrito aos irmãos</small>
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ── Botões de ação ── --}}
        <div class="d-flex flex-wrap gap-3 align-items-center p-3 rounded"
            style="background:#f8f9fa;border:1px solid #dee2e6">
            <button type="submit" class="btn btn-lg" style="background:#1a7a4a;color:#fff;border:none;min-width:200px">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ $editando ? 'Salvar Alterações' : 'Cadastrar Evento' }}
            </button>
            <a href="{{ route('eventos.index') }}" class="btn btn-lg btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Cancelar
            </a>
            <small class="text-muted ms-auto">
                <i class="bi bi-info-circle me-1"></i>
                Campos com <span class="text-danger fw-bold">*</span> são obrigatórios
            </small>
        </div>

    </form>

@endsection

{{-- ════════════════════════════════════════════════════════
     SCRIPTS — CKEditor 5 + Upload de imagens
     Idêntico ao form de notícias para manter consistência
     ════════════════════════════════════════════════════════ --}}
@push('scripts')
    {{-- CKEditor 5 CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Upload adapter — reutiliza a mesma rota do form de notícias ──
            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file.then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);

                        fetch('/admin/upload-imagem', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: data
                            })
                            .then(res => res.json())
                            .then(result => resolve({
                                default: result.url
                            }))
                            .catch(() => reject('Erro no upload da imagem.'));
                    }));
                }

                abort() {}
            }

            function MyUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader);
                };
            }

            // ── Inicializa o CKEditor no campo de conteúdo ──
            ClassicEditor
                .create(document.querySelector('#editor-conteudo'), {
                    extraPlugins: [MyUploadAdapterPlugin],
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'imageUpload', '|',
                        'blockQuote', '|',
                        'undo', 'redo'
                    ],
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Parágrafo',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Título 2',
                                class: 'ck-heading_heading2'
                            },
                            {
                                model: 'heading3',
                                view: 'h3',
                                title: 'Título 3',
                                class: 'ck-heading_heading3'
                            },
                        ]
                    }
                })
                .catch(error => console.error('CKEditor erro:', error));

            // ── Exibe o dia da semana ao selecionar a data ──
            const inputData = document.getElementById('data_inicio');
            const labelDia = document.getElementById('dia-semana-label');
            const diasPt = [
                'Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira',
                'Quinta-feira', 'Sexta-feira', 'Sábado'
            ];

            function atualizarDiaSemana() {
                if (!inputData.value) {
                    labelDia.textContent = '';
                    return;
                }
                const d = new Date(inputData.value + 'T00:00');
                labelDia.textContent = '📅 ' + diasPt[d.getDay()];
            }

            inputData.addEventListener('change', atualizarDiaSemana);
            atualizarDiaSemana(); // Executa ao carregar a página (modo edição)

        });
    </script>
@endpush
