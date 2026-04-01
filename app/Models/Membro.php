<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membro extends Model
{
    // SoftDelete: ao excluir, apenas preenche o campo deleted_at
    // O registro permanece no banco e pode ser recuperado
    use SoftDeletes;

    /**
     * Campos que podem ser preenchidos via mass assignment.
     * Todos os campos do formulário devem estar listados aqui.
     */
    protected $fillable = [
        // Dados maçônicos
        'cim',               // Removido cim_gosp — o CIM já é o número do GOSP
        'nome_maconico',
        'grau',
        'cargo_atual',
        'data_iniciacao',
        'data_elevacao',
        'data_exaltacao',
        'data_filiacao_loja',
        'loja_origem',
        'situacao',
        'tipo_membro',

        // Dados pessoais
        'nome_completo',
        'nome_civil',
        'foto',
        'data_nascimento',
        'naturalidade',
        'nacionalidade',
        'cpf',
        'rg',
        'orgao_expedidor',
        'titulo_eleitor',
        'profissao',
        'escolaridade',
        'estado_civil',

        // Contato
        'email',
        'email_alternativo',  // Adicionado
        'telefone',
        'celular',
        'whatsapp',

        // Endereço
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',

        // Acesso ao sistema (Fase 2)
        'senha',
        'acesso_ativo',

        // Controle
        'recebe_email',
        'observacoes',
    ];

    /**
     * Conversão automática de tipos ao acessar os atributos.
     * Datas são convertidas para objetos Carbon automaticamente.
     */
    protected $casts = [
        'data_nascimento'    => 'date',
        'data_iniciacao'     => 'date',
        'data_elevacao'      => 'date',
        'data_exaltacao'     => 'date',
        'data_filiacao_loja' => 'date',
        'acesso_ativo'       => 'boolean',
        'recebe_email'       => 'boolean',
    ];

    // ────────────────────────────────────────────────────────────
    // RELACIONAMENTOS
    // ────────────────────────────────────────────────────────────

    /**
     * Retorna todos os familiares do membro (esposa, filhos, filhas).
     */
    public function familiares()
    {
        return $this->hasMany(MembroFamiliar::class);
    }

    /**
     * Retorna apenas a esposa do membro.
     */
    public function esposa()
    {
        return $this->hasOne(MembroFamiliar::class)
            ->where('parentesco', 'esposa');
    }

    /**
     * Retorna os filhos e filhas do membro, ordenados por nascimento.
     */
    public function filhos()
    {
        return $this->hasMany(MembroFamiliar::class)
            ->whereIn('parentesco', ['filho', 'filha', 'enteado', 'enteada'])
            ->orderBy('data_nascimento');
    }

    /**
     * Retorna o histórico de cargos exercidos pelo membro.
     */
    public function historicoCargos()
    {
        return $this->hasMany(MembroHistoricoCargo::class)
            ->orderByDesc('ano_inicio');
    }

    // ────────────────────────────────────────────────────────────
    // ATRIBUTOS CALCULADOS (Accessors)
    // ────────────────────────────────────────────────────────────

    /**
     * Retorna o nome do grau maçônico por extenso.
     * Ex: grau 1 → "Aprendiz"
     */
    public function getGrauNomeAttribute(): string
    {
        return match ($this->grau) {
            1       => 'Aprendiz',
            2       => 'Companheiro',
            3       => 'Mestre',
            default => 'Grau ' . $this->grau,
        };
    }

    /**
     * Retorna a idade atual do irmão calculada a partir do nascimento.
     * Retorna null se a data não estiver preenchida.
     */
    public function getIdadeAttribute(): ?int
    {
        return $this->data_nascimento?->age;
    }

    /**
     * Verifica se hoje é o aniversário do irmão.
     * Usado na funcionalidade futura de envio de felicitações.
     */
    public function getAniversarioHojeAttribute(): bool
    {
        if (!$this->data_nascimento) {
            return false;
        }
        return $this->data_nascimento->format('d/m') === now()->format('d/m');
    }
}
