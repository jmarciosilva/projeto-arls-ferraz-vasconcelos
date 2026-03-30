@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Slides do Banner</h4>
        <a href="/admin/slides/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Novo Slide
        </a>
    </div>

    <div class="card">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th style="width:80px">Imagem</th>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Ordem</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($slides as $slide)
                    <tr>
                        <td>
                            @if ($slide->imagem)
                                <img src="{{ asset('storage/' . $slide->imagem) }}"
                                    style="height:48px;width:80px;object-fit:cover;border-radius:4px">
                            @else
                                <span class="text-muted small">Sem imagem</span>
                            @endif
                        </td>
                        <td>{{ $slide->titulo }}</td>
                        <td>{{ $slide->subtitulo ?? '—' }}</td>
                        <td>{{ $slide->ordem }}</td>
                        <td>
                            @if ($slide->ativo)
                                <span class="badge bg-success">Ativo</span>
                            @else
                                <span class="badge bg-secondary">Inativo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="/admin/slides/{{ $slide->id }}/edit"
                                class="btn btn-sm btn-outline-primary">Editar</a>
                            <form method="POST" action="/admin/slides/{{ $slide->id }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Remover este slide?')"
                                    class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Nenhum slide cadastrado ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
