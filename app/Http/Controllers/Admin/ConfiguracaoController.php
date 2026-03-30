<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function edit()
    {
        return view('admin.configuracoes.edit');
    }

    public function save(Request $request)
    {
        $campos = [
            'endereco',
            'horario',
            'facebook_url',
            'instagram_url',
            'whatsapp',
            'email_contato'
        ];
        foreach ($campos as $campo) {
            Configuracao::set($campo, $request->input($campo));
        }
        return back()->with('success', 'Configuracoes salvas!');
    }
}
