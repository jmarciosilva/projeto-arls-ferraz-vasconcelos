<?php
// database/migrations/xxxx_create_sessoes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de sessões do calendário da loja.
     * Cada sessão representa uma reunião agendada da ARLS.
     */
    public function up(): void
    {
        Schema::create('sessoes', function (Blueprint $table) {
            $table->id();

            // Data e hora da sessão
            $table->date('data');                          // Data da sessão
            $table->time('horario_inicio');                // Horário de início
            $table->time('horario_encerramento')->nullable(); // Horário previsto de encerramento

            // Identificação da sessão
            $table->string('nome', 200);                   // Ex: Sessão Grau 1 - Finanças
            $table->tinyInteger('grau')->unsigned()->default(1); // 1=Aprendiz, 2=Companheiro, 3=Mestre

            // Rito praticado
            $table->string('rito', 150)->default('Rito Escocês Antigo e Aceito');

            // Controle de exibição
            $table->boolean('publicado')->default(true);   // Exibir na home?
            $table->text('observacoes')->nullable();        // Informações adicionais

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessoes');
    }
};
