<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'titulo',
        'slug',            // Adicionado
        'descricao',
        'conteudo',        // Adicionado — conteúdo completo da página do evento
        'foto_capa',
        'tipo',
        'data_inicio',
        'data_fim',
        'horario_inicio',
        'horario_encerramento',
        'local_nome',
        'local_endereco',
        'link_maps',
        'link_waze',
        'aberto_publico',
        'link_inscricao',
        'publicado',
        'destaque',
    ];

    protected $casts = [
        'data_inicio'    => 'date',
        'data_fim'       => 'date',
        'aberto_publico' => 'boolean',
        'publicado'      => 'boolean',
        'destaque'       => 'boolean',
    ];

    /**
     * Gera o slug automaticamente ao criar o evento,
     * garantindo unicidade mesmo com títulos iguais.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($evento) {
            if (empty($evento->slug)) {
                $evento->slug = static::gerarSlugUnico($evento->titulo);
            }
        });

        static::updating(function ($evento) {
            // Regenera slug se o título mudou e o slug está vazio
            if ($evento->isDirty('titulo') && empty($evento->slug)) {
                $evento->slug = static::gerarSlugUnico($evento->titulo);
            }
        });
    }

    /**
     * Gera um slug único incrementando sufixo numérico se necessário.
     */
    public static function gerarSlugUnico(string $titulo): string
    {
        $base      = Str::slug($titulo);
        $slug      = $base;
        $contador  = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $contador++;
        }

        return $slug;
    }

    // ── Accessors ────────────────────────────────────────────

    public function getTipoLabelAttribute(): string
    {
        return [
            'geral'       => 'Geral',
            'jantar'      => 'Jantar Ritualístico',
            'palestra'    => 'Palestra',
            'festa'       => 'Festa / Confraternização',
            'visita'      => 'Visita a outra Loja',
            'comemora'    => 'Comemoração',
            'externo'     => 'Evento Externo',
            'beneficente' => 'Ação Beneficente',
        ][$this->tipo] ?? ucfirst($this->tipo);
    }

    public function getTipoCorAttribute(): string
    {
        return [
            'jantar'      => '#c62828',
            'palestra'    => '#1565c0',
            'festa'       => '#6a1a8a',
            'visita'      => '#1a7a4a',
            'comemora'    => '#c9a84c',
            'externo'     => '#546e7a',
            'beneficente' => '#2e7d32',
            'geral'       => '#1a3a5c',
        ][$this->tipo] ?? '#1a3a5c';
    }

    public function getIsFuturoAttribute(): bool
    {
        return $this->data_inicio->isFuture() || $this->data_inicio->isToday();
    }

    public function getIsMultiDiaAttribute(): bool
    {
        return $this->data_fim && $this->data_fim->ne($this->data_inicio);
    }

    public function getPeriodoAttribute(): string
    {
        if ($this->is_multi_dia) {
            return $this->data_inicio->format('d/m/Y') . ' a ' . $this->data_fim->format('d/m/Y');
        }
        return $this->data_inicio->format('d/m/Y');
    }

    public function getDiaSemanaAttribute(): string
    {
        $dias = [
            'Sunday' => 'Domingo', 'Monday' => 'Segunda-feira',
            'Tuesday' => 'Terça-feira', 'Wednesday' => 'Quarta-feira',
            'Thursday' => 'Quinta-feira', 'Friday' => 'Sexta-feira',
            'Saturday' => 'Sábado',
        ];
        return $dias[$this->data_inicio->format('l')] ?? '';
    }

    public function getMesExtensoAttribute(): string
    {
        return ['','Janeiro','Fevereiro','Março','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro']
               [(int) $this->data_inicio->format('n')];
    }

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto_capa ? asset('storage/' . $this->foto_capa) : null;
    }
}