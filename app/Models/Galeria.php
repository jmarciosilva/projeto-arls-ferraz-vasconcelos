<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = ['titulo', 'descricao', 'foto_capa', 'publicado'];
    protected $casts = ['publicado' => 'boolean'];
    public function fotos()
    {
        return $this->hasMany(GaleriaFoto::class)->orderBy('ordem');
    }
}
