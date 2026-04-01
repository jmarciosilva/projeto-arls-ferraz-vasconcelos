<?php
// app/Http/Controllers/Admin/SessaoController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SessaoController extends Controller
{
    // ────────────────────────────────────────────────────
    // Lista todas as sessões agendadas
    // ────────────────────────────────────────────────────
    public function index()
    {
        $sessoes = Sessao::orderBy('data', 'asc')->paginate(20);
        return view('admin.sessoes.index', compact('sessoes'));
    }

    // ────────────────────────────────────────────────────
    // Exibe o formulário de criação
    // ────────────────────────────────────────────────────
    public function create()
    {
        return view('admin.sessoes.form');
    }

    // ────────────────────────────────────────────────────
    // Salva nova sessão no banco de dados
    // ────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->regrasValidacao(),
            $this->mensagensValidacao()
        );

        DB::beginTransaction();

        try {
            $data['publicado'] = $request->has('publicado');
            Sessao::create($data);
            DB::commit();

            return redirect()->route('sessoes.index')
                ->with('success', 'Sessão cadastrada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao cadastrar sessão: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Erro ao salvar a sessão. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────
    // Exibe o formulário de edição
    // ────────────────────────────────────────────────────
    public function edit(Sessao $sessao)
    {
        return view('admin.sessoes.form', compact('sessao'));
    }

    // ────────────────────────────────────────────────────
    // Atualiza sessão existente
    // ────────────────────────────────────────────────────
    public function update(Request $request, Sessao $sessao)
    {
        $data = $request->validate(
            $this->regrasValidacao(),
            $this->mensagensValidacao()
        );

        DB::beginTransaction();

        try {
            $data['publicado'] = $request->has('publicado');
            $sessao->update($data);
            DB::commit();

            return redirect()->route('sessoes.index')
                ->with('success', 'Sessão atualizada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar sessão ID ' . $sessao->id . ': ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Erro ao atualizar a sessão. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────
    // Remove a sessão do banco
    // ────────────────────────────────────────────────────
    public function destroy(Sessao $sessao)
    {
        DB::beginTransaction();

        try {
            $sessao->delete();
            DB::commit();

            return back()->with('success', 'Sessão removida com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao remover sessão ID ' . $sessao->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao remover a sessão.');
        }
    }

    // ────────────────────────────────────────────────────
    // Regras de validação reutilizadas em store e update
    // ────────────────────────────────────────────────────
    private function regrasValidacao(): array
    {
        return [
            'data'                  => 'required|date',
            'horario_inicio'        => 'required',
            'horario_encerramento'  => 'nullable',
            'nome'                  => 'required|string|max:200',
            'grau'                  => 'required|integer|in:1,2,3',
            'rito'                  => 'required|string|max:150',
            'observacoes'           => 'nullable|string|max:1000',
        ];
    }

    // ────────────────────────────────────────────────────
    // Mensagens de erro em português
    // ────────────────────────────────────────────────────
    private function mensagensValidacao(): array
    {
        return [
            'data.required'          => 'Informe a data da sessão.',
            'data.date'              => 'Data inválida.',
            'horario_inicio.required' => 'Informe o horário de início.',
            'nome.required'          => 'Informe o nome da sessão.',
            'grau.required'          => 'Selecione o grau da sessão.',
            'grau.in'                => 'Grau inválido. Selecione 1°, 2° ou 3°.',
            'rito.required'          => 'Informe o rito.',
        ];
    }
}
