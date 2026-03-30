@extends('admin.layouts.app')
@section('content')
    <h4>Configuracoes da Loja</h4>
    <form method="POST" action="/admin/configuracoes" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Endereco Completo</label>
            <input name="endereco" class="form-control" value="{{ \App\Models\Configuracao::get('endereco') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Horario das Reunioes</label>
            <input name="horario" class="form-control" value="{{ \App\Models\Configuracao::get('horario') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">URL do Facebook</label>
            <input name="facebook_url" class="form-control" value="{{ \App\Models\Configuracao::get('facebook_url') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">URL do Instagram</label>
            <input name="instagram_url" class="form-control" value="{{ \App\Models\Configuracao::get('instagram_url') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">WhatsApp (com DDD, sem espacos)</label>
            <input name="whatsapp" class="form-control" value="{{ \App\Models\Configuracao::get('whatsapp') }}">
        </div>
        <button class="btn btn-primary">Salvar Configuracoes</button>
    </form>
@endsection
