@extends('admin.layouts.app')

@section('content')
    <h3 class="fw-bold mb-4" style="color:#1a3a5c">
        <i class="bi bi-pencil-square me-2"></i>
        {{ isset($noticia) ? 'Editar Notícia' : 'Nova Notícia' }}
    </h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Corrija os erros:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($noticia) ? route('noticias.update', $noticia) : route('noticias.store') }}"
        enctype="multipart/form-data">

        @csrf
        @if (isset($noticia))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Título *</label>
            <input name="titulo" class="form-control" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>

            <select name="categoria_id" class="form-select">
                <option value="">— Sem categoria —</option>

                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('categoria_id', $noticia->categoria_id ?? '') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nome }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Resumo</label>
            <textarea name="resumo" class="form-control" rows="2">{{ old('resumo', $noticia->resumo ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo *</label>
            <textarea id="editor" name="conteudo">{{ old('conteudo', $noticia->conteudo ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Foto de capa</label>
            <input type="file" name="foto_capa" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="publicado" class="form-check-input"
                {{ old('publicado', $noticia->publicado ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Publicar no site</label>
        </div>

        <button class="btn btn-lg btn-success">
            Salvar
        </button>

    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            class MyUploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file.then(file => new Promise((resolve, reject) => {

                        let data = new FormData();
                        data.append('upload', file);

                        fetch('/admin/upload-imagem', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: data
                            })
                            .then(response => response.json())
                            .then(result => {
                                resolve({
                                    default: result.url
                                });
                            })
                            .catch(error => {
                                reject('Erro no upload');
                            });

                    }));
                }

                abort() {}
            }

            function MyCustomUploadAdapterPlugin(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new MyUploadAdapter(loader);
                };
            }

            ClassicEditor
                .create(document.querySelector('#editor'), {
                    extraPlugins: [MyCustomUploadAdapterPlugin],

                    toolbar: [
                        'heading',
                        '|',
                        'bold', 'italic', 'link',
                        '|',
                        'bulletedList', 'numberedList',
                        '|',
                        'imageUpload',
                        '|',
                        'undo', 'redo'
                    ]
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endsection
