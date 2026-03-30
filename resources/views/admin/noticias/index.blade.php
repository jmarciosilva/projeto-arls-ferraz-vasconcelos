@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Noticias</h4>
        <a href="/admin/noticias/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Nova Noticia
        </a>
    </div>
    <div class="card">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($noticias as $n)
                    <tr>
                        <td>{{ $n->titulo }}</td>
                        <td>
                            @if ($n->publicado)
                                <span class="badge bg-success">Publicada</span>
                            @else
                                <span class="badge bg-secondary">Rascunho</span>
                            @endif
                        </td>
                        <td>{{ $n->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="/admin/noticias/{{ $n->id }}/edit"
                                class="btn btn-sm btn-outline-primary">Editar</a>
                            <form method="POST" action="/admin/noticias/{{ $n->id }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Excluir?')"
                                    class="btn btn-sm btn-outline-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Nenhuma noticia cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $noticias->links() }}</div>
@endsection
