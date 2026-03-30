<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Noticia extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'resumo',
        'conteudo',
        'foto_capa',
        'publicado',
        'publicado_em',
        'user_id'
    ];
    protected $casts = [
        'publicado'    => 'boolean',
        'publicado_em' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($n) {
            if (empty($n->slug)) $n->slug = Str::slug($n->titulo);
        });
    }
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
