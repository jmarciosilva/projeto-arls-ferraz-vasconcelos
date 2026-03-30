@extends('admin.layouts.app')
@section('content')
    <h4>{{ isset($slide) ? 'Editar Slide' : 'Novo Slide' }}</h4>

    <form method="POST" action="{{ isset($slide) ? '/admin/slides/' . $slide->id : '/admin/slides' }}"
        enctype="multipart/form-data" class="mt-3" style="max-width:680px">
        @csrf
        @if (isset($slide))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Título <span class="text-danger">*</span></label>
            <input name="titulo" class="form-control @error('titulo') is-invalid @enderror"
                value="{{ old('titulo', $slide->titulo ?? '') }}" required>
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Subtítulo</label>
            <input name="subtitulo" class="form-control" value="{{ old('subtitulo', $slide->subtitulo ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem de Fundo</label>
            @if (isset($slide) && $slide->imagem)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $slide->imagem) }}" style="max-height:120px;border-radius:6px">
                    <p class="text-muted small mt-1">Envie uma nova imagem para substituir.</p>
                </div>
            @endif
            <input name="imagem" type="file" class="form-control @error('imagem') is-invalid @enderror"
                accept="image/*">
            @error('imagem')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Recomendado: 1920x800px, máx. 4MB.</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Link (opcional)</label>
            <input name="link" type="url" class="form-control" placeholder="https://..."
                value="{{ old('link', $slide->link ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Ordem de exibição</label>
            <input name="ordem" type="number" min="0" class="form-control" style="width:120px"
                value="{{ old('ordem', $slide->ordem ?? 0) }}">
            <div class="form-text">Menor número aparece primeiro.</div>
        </div>

        <div class="mb-4 form-check">
            <input name="ativo" type="checkbox" class="form-check-input" id="ativo"
                {{ old('ativo', $slide->ativo ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">Slide ativo (visível no site)</label>
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="/admin/slides" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection
