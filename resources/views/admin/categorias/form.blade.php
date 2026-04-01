@extends('admin.layouts.app')

@section('content')
    <h3 class="fw-bold mb-4">
        {{ isset($categoria) ? 'Editar Categoria' : 'Nova Categoria' }}
    </h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
        action="{{ isset($categoria) ? route('categorias.update', $categoria) : route('categorias.store') }}">

        @csrf
        @if (isset($categoria))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Nome da Categoria</label>

            <input type="text" name="nome" class="form-control" value="{{ old('nome', $categoria->nome ?? '') }}"
                required>
        </div>

        <button class="btn btn-success">
            Salvar
        </button>

        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>
@endsection
