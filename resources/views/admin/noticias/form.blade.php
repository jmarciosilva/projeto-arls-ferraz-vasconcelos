@extends('admin.layouts.app')
@section('content')
    <h4>{{ isset($noticia) ? 'Editar Noticia' : 'Nova Noticia' }}</h4>
    <form method="POST" action="{{ isset($noticia) ? '/admin/noticias/' . $noticia->id : '/admin/noticias' }}"
        enctype="multipart/form-data" class="mt-3">
        @csrf
        @if (isset($noticia))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label class="form-label">Titulo</label>
            <input name="titulo" class="form-control" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Resumo (opcional)</label>
            <textarea name="resumo" class="form-control" rows="2">{{ old('resumo', $noticia->resumo ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Conteudo</label>
            <textarea name="conteudo" id="editor" class="form-control" rows="12">{{ old('conteudo', $noticia->conteudo ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto de Capa</label>
            @if (isset($noticia) && $noticia->foto_capa)
                <img src="{{ asset('storage/' . $noticia->foto_capa) }}" class="d-block mb-2" style="max-height:120px">
            @endif
            <input name="foto_capa" type="file" class="form-control" accept="image/*">
        </div>
        <div class="mb-3 form-check">
            <input name="publicado" type="checkbox" class="form-check-input" id="pub"
                {{ old('publicado', $noticia->publicado ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="pub">Publicar no site</label>
        </div>
        <button class="btn btn-primary">Salvar</button>
        <a href="/admin/noticias" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            language: 'pt_BR',
            plugins: 'lists link image table',
            toolbar: 'undo redo | bold italic | bullist numlist | link image | table'
        });
    </script>
@endpush
