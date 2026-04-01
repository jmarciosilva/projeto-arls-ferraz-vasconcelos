<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    /**
     * ============================================================
     * CAMPOS QUE PODEM SER PREENCHIDOS EM MASSA
     * ============================================================
     */
    protected $fillable = [
        'nome',
        'slug',
    ];

    /**
     * ============================================================
     * EVENTO AUTOMÁTICO AO CRIAR
     * ============================================================
     * Gera slug automaticamente caso não seja informado
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            if (empty($categoria->slug)) {
                $categoria->slug = Str::slug($categoria->nome);
            }
        });
    }

    /**
     * ============================================================
     * RELACIONAMENTO COM NOTÍCIAS
     * ============================================================
     * Uma categoria pode ter várias notícias
     */
    public function noticias()
    {
        return $this->hasMany(Noticia::class);
    }
}
