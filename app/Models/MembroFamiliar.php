<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembroFamiliar extends Model
{
    /**
     * Nome explícito da tabela no banco de dados.
     */
    protected $table = 'membro_familiares';

    /**
     * Campos que podem ser preenchidos via mass assignment.
     */
    protected $fillable = [
        'membro_id',       // ID do membro pai
        'parentesco',      // esposa, filho, filha, enteado, enteada
        'nome',            // Nome completo do familiar
        'data_nascimento', // Para envio de felicitações de aniversário
        'data_casamento',  // Para envio de felicitações de casamento (esposa)
        'email',           // E-mail para receber felicitações
        'telefone',        // Telefone de contato
        'recebe_felicitacao', // Se deve receber e-mails automáticos
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'data_nascimento'    => 'date',
        'data_casamento'     => 'date',
        'recebe_felicitacao' => 'boolean',
    ];

    // ────────────────────────────────────────────────────────────
    // RELACIONAMENTOS
    // ────────────────────────────────────────────────────────────

    /**
     * Retorna o membro (irmão maçom) ao qual este familiar pertence.
     */
    public function membro()
    {
        return $this->belongsTo(Membro::class);
    }

    // ────────────────────────────────────────────────────────────
    // ATRIBUTOS CALCULADOS (Accessors)
    // ────────────────────────────────────────────────────────────

    /**
     * Verifica se hoje é o aniversário deste familiar.
     * Usado no envio automático de felicitações (Fase 2).
     */
    public function getAniversarioHojeAttribute(): bool
    {
        if (!$this->data_nascimento) {
            return false;
        }
        return $this->data_nascimento->format('d/m') === now()->format('d/m');
    }

    /**
     * Verifica se hoje é o aniversário de casamento (somente para esposa).
     * Usado no envio automático de felicitações (Fase 2).
     */
    public function getAniversarioCasamentoHojeAttribute(): bool
    {
        if (!$this->data_casamento) {
            return false;
        }
        return $this->data_casamento->format('d/m') === now()->format('d/m');
    }
}
