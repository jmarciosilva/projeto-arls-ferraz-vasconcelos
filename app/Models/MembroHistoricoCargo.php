<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembroHistoricoCargo extends Model
{
    /**
     * Nome explícito da tabela no banco de dados.
     */
    protected $table = 'membro_historico_cargos';

    /**
     * Campos que podem ser preenchidos via mass assignment.
     */
    protected $fillable = [
        'membro_id',   // ID do membro que exerceu o cargo
        'cargo',       // Nome do cargo (ex: Venerável Mestre, Secretário)
        'ano_inicio',  // Ano em que começou a exercer o cargo
        'ano_fim',     // Ano em que deixou o cargo (null = ainda em exercício)
        'observacao',  // Anotações complementares sobre o período
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'ano_inicio' => 'integer',
        'ano_fim'    => 'integer',
    ];

    // ────────────────────────────────────────────────────────────
    // RELACIONAMENTOS
    // ────────────────────────────────────────────────────────────

    /**
     * Retorna o membro (irmão maçom) ao qual este cargo pertence.
     */
    public function membro()
    {
        return $this->belongsTo(Membro::class);
    }

    // ────────────────────────────────────────────────────────────
    // ATRIBUTOS CALCULADOS (Accessors)
    // ────────────────────────────────────────────────────────────

    /**
     * Retorna o período de vigência do cargo formatado.
     * Ex: "2022 — 2023" ou "2024 — atual"
     */
    public function getVigenciaAttribute(): string
    {
        $fim = $this->ano_fim ?? 'atual';
        return "{$this->ano_inicio} — {$fim}";
    }
}