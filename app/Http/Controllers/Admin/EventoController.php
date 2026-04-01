<?php
// app/Http/Controllers/Admin/EventoController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    // ────────────────────────────────────────────────────
    // Lista todos os eventos com filtros
    // ────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Evento::query();

        // Filtro por tipo de evento
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtro por período (futuros ou passados)
        if ($request->filled('periodo')) {
            match ($request->periodo) {
                'futuros'  => $query->where('data_inicio', '>=', today()),
                'passados' => $query->where('data_inicio', '<', today()),
                default    => null,
            };
        }

        // Filtro por visibilidade
        if ($request->filled('publicado')) {
            $query->where('publicado', (bool) $request->publicado);
        }

        // Ordena por data mais recente primeiro
        $eventos = $query->orderBy('data_inicio', 'asc')->paginate(20)->withQueryString();

        return view('admin.eventos.index', compact('eventos'));
    }

    // ────────────────────────────────────────────────────
    // Exibe formulário de criação
    // ────────────────────────────────────────────────────
    public function create()
    {
        return view('admin.eventos.form');
    }

    // ────────────────────────────────────────────────────
    // Salva novo evento no banco
    // ────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->regrasValidacao(),
            $this->mensagensValidacao()
        );

        DB::beginTransaction();

        try {
            // Upload da foto de capa
            if ($request->hasFile('foto_capa')) {
                $data['foto_capa'] = $request->file('foto_capa')
                    ->store('eventos', 'public');
            }

            // Checkboxes
            $data['publicado']      = $request->has('publicado');
            $data['destaque']       = $request->has('destaque');
            $data['aberto_publico'] = $request->has('aberto_publico');

            Evento::create($data);
            DB::commit();

            return redirect()->route('eventos.index')
                ->with('success', 'Evento cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            if (!empty($data['foto_capa'])) {
                Storage::disk('public')->delete($data['foto_capa']);
            }
            Log::error('Erro ao cadastrar evento: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Erro ao salvar o evento. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────
    // Exibe formulário de edição
    // ────────────────────────────────────────────────────
    public function edit(Evento $evento)
    {
        return view('admin.eventos.form', compact('evento'));
    }

    // ────────────────────────────────────────────────────
    // Atualiza evento existente
    // ────────────────────────────────────────────────────
    public function update(Request $request, Evento $evento)
    {
        $data = $request->validate(
            $this->regrasValidacao(),
            $this->mensagensValidacao()
        );

        DB::beginTransaction();

        try {
            // Substituição de foto se enviada nova
            if ($request->hasFile('foto_capa')) {
                if ($evento->foto_capa) {
                    Storage::disk('public')->delete($evento->foto_capa);
                }
                $data['foto_capa'] = $request->file('foto_capa')
                    ->store('eventos', 'public');
            }

            // Checkboxes
            $data['publicado']      = $request->has('publicado');
            $data['destaque']       = $request->has('destaque');
            $data['aberto_publico'] = $request->has('aberto_publico');

            $evento->update($data);
            DB::commit();

            return redirect()->route('eventos.index')
                ->with('success', 'Evento atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar evento ID ' . $evento->id . ': ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Erro ao atualizar o evento. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────
    // Remove o evento permanentemente
    // ────────────────────────────────────────────────────
    public function destroy(Evento $evento)
    {
        DB::beginTransaction();

        try {
            // Remove a foto do storage antes de excluir
            if ($evento->foto_capa) {
                Storage::disk('public')->delete($evento->foto_capa);
            }

            $evento->delete();
            DB::commit();

            return back()->with('success', 'Evento removido com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao remover evento ID ' . $evento->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao remover o evento.');
        }
    }

    // ────────────────────────────────────────────────────
    // Regras de validação reutilizadas
    // ────────────────────────────────────────────────────
    private function regrasValidacao(): array
    {
        return [
            'titulo'               => 'required|string|max:200',
            'descricao'            => 'nullable|string|max:2000',
            'foto_capa'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'tipo'                 => 'required|string|max:100',
            'data_inicio'          => 'required|date',
            'data_fim'             => 'nullable|date|after_or_equal:data_inicio',
            'horario_inicio'       => 'nullable',
            'horario_encerramento' => 'nullable',
            'local_nome'           => 'nullable|string|max:200',
            'local_endereco'       => 'nullable|string|max:300',
            'link_maps'            => 'nullable|url|max:500',
            'link_waze'            => 'nullable|url|max:500',
            'link_inscricao'       => 'nullable|url|max:500',
            'conteudo'             => 'nullable|string',
            'slug'                 => 'nullable|string|max:200',
        ];
    }

    // ────────────────────────────────────────────────────
    // Mensagens de validação em português
    // ────────────────────────────────────────────────────
    private function mensagensValidacao(): array
    {
        return [
            'titulo.required'       => 'Informe o título do evento.',
            'tipo.required'         => 'Selecione o tipo do evento.',
            'data_inicio.required'  => 'Informe a data de início do evento.',
            'data_inicio.date'      => 'Data de início inválida.',
            'data_fim.after_or_equal' => 'A data de fim deve ser igual ou posterior à data de início.',
            'foto_capa.image'       => 'O arquivo deve ser uma imagem.',
            'foto_capa.mimes'       => 'Formatos aceitos: JPG, PNG, WEBP.',
            'foto_capa.max'         => 'A imagem não pode ter mais de 4MB.',
            'link_maps.url'         => 'O link do Google Maps deve ser uma URL válida.',
            'link_waze.url'         => 'O link do Waze deve ser uma URL válida.',
            'link_inscricao.url'    => 'O link de inscrição deve ser uma URL válida.',
        ];
    }
}
