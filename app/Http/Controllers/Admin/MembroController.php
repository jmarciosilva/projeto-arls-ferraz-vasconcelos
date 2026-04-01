<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membro;
use App\Models\MembroFamiliar;
use App\Models\MembroHistoricoCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MembroController extends Controller
{
    // ────────────────────────────────────────────────────────────
    // Lista todos os membros com filtros de busca
    // ────────────────────────────────────────────────────────────
    public function index(Request $request)
    {
        try {
            $query = Membro::query();

            // Filtro por nome, CIM ou nome simbólico
            if ($request->filled('busca')) {
                $query->where(function ($q) use ($request) {
                    $q->where('nome_completo', 'like', '%' . $request->busca . '%')
                        ->orWhere('cim', 'like', '%' . $request->busca . '%')
                        ->orWhere('nome_maconico', 'like', '%' . $request->busca . '%');
                });
            }

            // Filtro por situação (ativo, inativo, suspenso, etc.)
            if ($request->filled('situacao')) {
                $query->where('situacao', $request->situacao);
            }

            // Filtro por grau maçônico (1, 2 ou 3)
            if ($request->filled('grau')) {
                $query->where('grau', $request->grau);
            }

            // Ordena pelo nome e pagina os resultados
            $membros = $query->orderBy('nome_completo')->paginate(20)->withQueryString();

            return view('admin.membros.index', compact('membros'));
        } catch (\Exception $e) {
            Log::error('Erro ao listar membros: ' . $e->getMessage());
            return back()->with('error', 'Erro ao carregar a lista de membros.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Exibe o formulário de criação de novo membro
    // ────────────────────────────────────────────────────────────
    public function create()
    {
        return view('admin.membros.form');
    }

    // ────────────────────────────────────────────────────────────
    // Salva um novo membro no banco de dados
    // ────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        // Validação dos dados enviados pelo formulário
        $data = $request->validate(
            $this->regrasValidacao(),
            $this->mensagensValidacao()
        );

        // Inicia transação para garantir consistência no banco
        DB::beginTransaction();

        try {
            // Processa o upload da foto, se enviada
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('membros', 'public');
            }

            // Checkbox: se não marcado, o valor não vem no request — força false
            $data['recebe_email'] = $request->has('recebe_email');

            // Cria o membro no banco
            Membro::create($data);

            // Confirma a transação
            DB::commit();

            return redirect('/admin/membros')
                ->with('success', 'Irmão cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Desfaz qualquer alteração feita no banco
            DB::rollBack();

            // Remove a foto enviada caso o cadastro tenha falhado
            if (!empty($data['foto'])) {
                Storage::disk('public')->delete($data['foto']);
            }

            Log::error('Erro ao cadastrar membro: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar o irmão. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Exibe o perfil completo do membro (com familiares e cargos)
    // ────────────────────────────────────────────────────────────
    public function show(Membro $membro)
    {
        try {
            // Carrega os relacionamentos para evitar N+1 queries
            $membro->load(['familiares', 'historicoCargos']);

            return view('admin.membros.show', compact('membro'));
        } catch (\Exception $e) {
            Log::error('Erro ao exibir membro ID ' . $membro->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao carregar o perfil do irmão.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Exibe o formulário de edição do membro
    // ────────────────────────────────────────────────────────────
    public function edit(Membro $membro)
    {
        // Carrega familiares e histórico de cargos para exibir no form
        $membro->load(['familiares', 'historicoCargos']);

        return view('admin.membros.form', compact('membro'));
    }

    // ────────────────────────────────────────────────────────────
    // Atualiza os dados do membro no banco de dados
    // ────────────────────────────────────────────────────────────
    public function update(Request $request, Membro $membro)
    {
        // Validação com exceção para os campos únicos do próprio registro
        $data = $request->validate(
            $this->regrasValidacao($membro->id),
            $this->mensagensValidacao()
        );

        // Inicia transação para garantir consistência no banco
        DB::beginTransaction();

        try {
            // Se uma nova foto foi enviada, remove a antiga e salva a nova
            if ($request->hasFile('foto')) {
                if ($membro->foto) {
                    Storage::disk('public')->delete($membro->foto);
                }
                $data['foto'] = $request->file('foto')->store('membros', 'public');
            }

            // Checkbox: se não marcado, o valor não vem no request — força false
            $data['recebe_email'] = $request->has('recebe_email');

            // Atualiza os dados do membro
            $membro->update($data);

            // Confirma a transação
            DB::commit();

            return redirect('/admin/membros/' . $membro->id)
                ->with('success', 'Dados do irmão atualizados com sucesso!');
        } catch (\Exception $e) {
            // Desfaz qualquer alteração feita no banco
            DB::rollBack();

            Log::error('Erro ao atualizar membro ID ' . $membro->id . ': ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar os dados. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Arquiva o membro usando SoftDelete (não apaga do banco)
    // ────────────────────────────────────────────────────────────
    public function destroy(Membro $membro)
    {
        DB::beginTransaction();

        try {
            // SoftDelete: apenas marca deleted_at, preserva os dados
            $membro->delete();

            DB::commit();

            return redirect('/admin/membros')
                ->with('success', 'Irmão arquivado. Os dados foram preservados.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao arquivar membro ID ' . $membro->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao arquivar o irmão. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Adiciona um familiar (esposa, filho ou filha) ao membro
    // ────────────────────────────────────────────────────────────
    public function storeFamiliar(Request $request, Membro $membro)
    {
        $data = $request->validate([
            'parentesco'         => 'required|in:esposa,filho,filha,enteado,enteada',
            'nome'               => 'required|string|max:200',
            'data_nascimento'    => 'nullable|date',
            'data_casamento'     => 'nullable|date',
            'email'              => 'nullable|email|max:150',
            'telefone'           => 'nullable|string|max:20',
            'recebe_felicitacao' => 'boolean',
        ], [
            'parentesco.required' => 'Informe o parentesco.',
            'nome.required'       => 'Informe o nome do familiar.',
        ]);

        DB::beginTransaction();

        try {
            // Regra: cada membro pode ter apenas uma esposa cadastrada
            if ($data['parentesco'] === 'esposa') {
                $membro->familiares()->where('parentesco', 'esposa')->delete();
            }

            // Checkbox de felicitação
            $data['recebe_felicitacao'] = $request->has('recebe_felicitacao');

            // Cria o familiar vinculado ao membro
            $membro->familiares()->create($data);

            DB::commit();

            return back()->with('success', 'Familiar adicionado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao adicionar familiar do membro ID ' . $membro->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao adicionar o familiar. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Remove um familiar do membro
    // ────────────────────────────────────────────────────────────
    public function destroyFamiliar(MembroFamiliar $familiar)
    {
        DB::beginTransaction();

        try {
            $familiar->delete();

            DB::commit();

            return back()->with('success', 'Familiar removido com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao remover familiar ID ' . $familiar->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao remover o familiar. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Adiciona um cargo ao histórico do membro
    // ────────────────────────────────────────────────────────────
    public function storeCargo(Request $request, Membro $membro)
    {
        $anoMaximo = date('Y') + 1;

        $data = $request->validate([
            'cargo'      => 'required|string|max:100',
            'ano_inicio' => "required|integer|min:1900|max:{$anoMaximo}",
            'ano_fim'    => "nullable|integer|min:1900|max:{$anoMaximo}",
            'observacao' => 'nullable|string|max:500',
        ], [
            'cargo.required'      => 'Informe o nome do cargo.',
            'ano_inicio.required' => 'Informe o ano de início.',
            'ano_inicio.integer'  => 'O ano de início deve ser um número.',
        ]);

        DB::beginTransaction();

        try {
            // Registra o cargo no histórico do membro
            $membro->historicoCargos()->create($data);

            DB::commit();

            return back()->with('success', 'Cargo adicionado ao histórico!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao adicionar cargo do membro ID ' . $membro->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao adicionar o cargo. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // Remove um cargo do histórico do membro
    // ────────────────────────────────────────────────────────────
    public function destroyCargo(MembroHistoricoCargo $cargo)
    {
        DB::beginTransaction();

        try {
            $cargo->delete();

            DB::commit();

            return back()->with('success', 'Cargo removido do histórico.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao remover cargo ID ' . $cargo->id . ': ' . $e->getMessage());
            return back()->with('error', 'Erro ao remover o cargo. Tente novamente.');
        }
    }

    // ────────────────────────────────────────────────────────────
    // MÉTODOS PRIVADOS — Reutilizados em store() e update()
    // ────────────────────────────────────────────────────────────

    /**
     * Retorna as regras de validação do formulário de membro.
     * O $id é usado no update para ignorar o próprio registro
     * nos campos únicos (cim, cpf, email).
     */
    private function regrasValidacao(?int $id = null): array
    {
        // Sufixo para ignorar o próprio registro na validação unique
        $ignorar = $id ? ',' . $id : '';

        return [
            // ── Dados Maçônicos ──────────────────────────────
            'cim'                => "nullable|string|max:50|unique:membros,cim{$ignorar}",
            'nome_maconico'      => 'nullable|string|max:100',
            'grau'               => 'required|integer|in:1,2,3',
            'cargo_atual'        => 'nullable|string|max:100',
            'data_iniciacao'     => 'nullable|date',
            'data_elevacao'      => 'nullable|date',
            'data_exaltacao'     => 'nullable|date',
            'data_filiacao_loja' => 'nullable|date',
            'loja_origem'        => 'nullable|string|max:150',
            'situacao'           => 'required|string|in:ativo,inativo,suspenso,remido,benemerito,fundador,transferido,falecido',
            'tipo_membro'        => 'nullable|string|in:efetivo,honorario,correspondente',

            // ── Dados Pessoais ───────────────────────────────
            'nome_completo'      => 'required|string|max:200',
            'nome_civil'         => 'nullable|string|max:200',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'data_nascimento'    => 'nullable|date',
            'naturalidade'       => 'nullable|string|max:100',
            'nacionalidade'      => 'nullable|string|max:100',
            'cpf'                => "nullable|string|max:14|unique:membros,cpf{$ignorar}",
            'rg'                 => 'nullable|string|max:20',
            'orgao_expedidor'    => 'nullable|string|max:20',
            'titulo_eleitor'     => 'nullable|string|max:20',
            'profissao'          => 'nullable|string|max:100',
            'escolaridade'       => 'nullable|string|max:100',
            'estado_civil'       => 'nullable|string|in:solteiro,casado,divorciado,viuvo,uniao_estavel',

            // ── Contato ──────────────────────────────────────
            'email'              => "nullable|email|max:150|unique:membros,email{$ignorar}",
            'email_alternativo'  => 'nullable|email|max:150',
            'telefone'           => 'nullable|string|max:20',
            'celular'            => 'nullable|string|max:20',
            'whatsapp'           => 'nullable|string|max:20',

            // ── Endereço ─────────────────────────────────────
            'cep'                => 'nullable|string|max:10',
            'logradouro'         => 'nullable|string|max:200',
            'numero'             => 'nullable|string|max:10',
            'complemento'        => 'nullable|string|max:100',
            'bairro'             => 'nullable|string|max:100',
            'cidade'             => 'nullable|string|max:100',
            'estado'             => 'nullable|string|max:2',

            // ── Controle ─────────────────────────────────────
            'observacoes'        => 'nullable|string|max:2000',
        ];
    }

    /**
     * Retorna as mensagens de erro personalizadas em português
     * para a validação do formulário de membro.
     */
    private function mensagensValidacao(): array
    {
        return [
            'grau.required'          => 'O grau maçônico é obrigatório.',
            'grau.in'                => 'Grau inválido. Selecione Aprendiz, Companheiro ou Mestre.',
            'situacao.required'      => 'A situação do irmão é obrigatória.',
            'situacao.in'            => 'Situação inválida.',
            'nome_completo.required' => 'O nome completo é obrigatório. Preencha a aba "Dados Pessoais".',
            'nome_completo.max'      => 'O nome completo não pode ter mais de 200 caracteres.',
            'foto.image'             => 'O arquivo enviado não é uma imagem válida.',
            'foto.mimes'             => 'A foto deve ser nos formatos: JPG, PNG ou WEBP.',
            'foto.max'               => 'A foto não pode ter mais de 2MB.',
            'cpf.unique'             => 'Este CPF já está cadastrado para outro irmão.',
            'cim.unique'             => 'Este CIM já está cadastrado para outro irmão.',
            'email.unique'           => 'Este e-mail já está cadastrado para outro irmão.',
            'email.email'            => 'Informe um endereço de e-mail válido.',
        ];
    }
}
