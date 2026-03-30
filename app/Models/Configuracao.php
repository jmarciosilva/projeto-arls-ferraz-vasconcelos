<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes';
    protected $fillable = ['chave', 'valor'];

    // Uso: Configuracao::get('facebook_url', '#')
    public static function get(string $chave, $default = null)
    {
        return static::where('chave', $chave)->value('valor') ?? $default;
    }
    // Uso: Configuracao::set('facebook_url', 'https://...')
    public static function set(string $chave, $valor): void
    {
        static::updateOrCreate(['chave' => $chave], ['valor' => $valor]);
    }
}
