<?php
// app/Models/Sessao.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    /**
     * Nome explícito da tabela no banco de dados.
     * Necessário pois o Laravel pluraliza "Sessao" como "sessaos"
     * em vez de "sessoes".
     */
    protected $table = 'sessoes';

    /**
     * Campos que podem ser preenchidos via mass assignment.
     */
    protected $fillable = [
        'data',
        'horario_inicio',
        'horario_encerramento',
        'nome',
        'grau',
        'rito',
        'publicado',
        'observacoes',
    ];

    /**
     * Conversão automática de tipos.
     */
    protected $casts = [
        'data'      => 'date',
        'publicado' => 'boolean',
        'grau'      => 'integer',
    ];

    // ────────────────────────────────────────────────────
    // ATRIBUTOS CALCULADOS
    // ────────────────────────────────────────────────────

    /**
     * Retorna o nome do grau por extenso.
     */
    public function getGrauNomeAttribute(): string
    {
        return match ($this->grau) {
            1       => '1° Grau — Aprendiz',
            2       => '2° Grau — Companheiro',
            3       => '3° Grau — Mestre',
            default => $this->grau . '° Grau',
        };
    }

    /**
     * Retorna o dia da semana em português.
     */
    public function getDiaSemanaAttribute(): string
    {
        $dias = [
            'Sunday'    => 'Domingo',
            'Monday'    => 'Segunda-feira',
            'Tuesday'   => 'Terça-feira',
            'Wednesday' => 'Quarta-feira',
            'Thursday'  => 'Quinta-feira',
            'Friday'    => 'Sexta-feira',
            'Saturday'  => 'Sábado',
        ];
        return $dias[$this->data->format('l')] ?? $this->data->format('l');
    }

    /**
     * Verifica se a sessão é futura (ainda não aconteceu).
     */
    public function getIsFuturaAttribute(): bool
    {
        return $this->data->isFuture() || $this->data->isToday();
    }
}
