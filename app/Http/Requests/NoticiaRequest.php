<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'    => 'required|string|max:255',
            'resumo'    => 'nullable|string|max:500',
            'conteudo'  => 'required|string',
            'foto_capa' => 'nullable|image|max:4096',
            'publicado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'Informe o título da notícia.',
            'conteudo.required' => 'O conteúdo da notícia é obrigatório.',
            'foto_capa.image' => 'A imagem deve ser válida.',
        ];
    }
}