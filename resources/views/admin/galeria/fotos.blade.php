@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Fotos: {{ $galeria->titulo }}</h4>
        <a href="/admin/galeria" class="btn btn-secondary btn-sm">Voltar</a>
    </div>

    <form method="POST" action="/admin/galeria/{{ $galeria->id }}/fotos" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="input-group">
            <input name="fotos[]" type="file" class="form-control" multiple accept="image/*">
            <button class="btn btn-primary">Enviar Fotos</button>
        </div>
    </form>

    <div class="row g-3">
        @foreach ($galeria->fotos as $foto)
            <div class="col-6 col-md-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $foto->arquivo) }}" class="card-img-top"
                        style="height:140px;object-fit:cover">
                    <div class="card-body p-2 text-end">
                        <form method="POST" action="/admin/galeria/fotos/{{ $foto->id }}">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Excluir foto?')" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
