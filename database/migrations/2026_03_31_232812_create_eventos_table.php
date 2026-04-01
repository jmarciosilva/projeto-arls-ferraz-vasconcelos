<?php
// database/migrations/xxxx_create_eventos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de eventos da ARLS Ferraz de Vasconcelos.
     * Eventos são diferentes de sessões — incluem festas, palestras,
     * jantares, visitas, comemorações e eventos externos.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();

            // Identificação do evento
            $table->string('titulo', 200);
            $table->text('descricao')->nullable();
            $table->string('foto_capa')->nullable();

            // Tipo do evento
            $table->string('tipo', 100)->default('geral');

            // Data e hora
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();        // Para eventos de múltiplos dias
            $table->time('horario_inicio')->nullable();
            $table->time('horario_encerramento')->nullable();

            // Local
            $table->string('local_nome', 200)->nullable();   // Nome do local
            $table->string('local_endereco')->nullable();     // Endereço completo
            $table->string('link_maps')->nullable();          // Link Google Maps
            $table->string('link_waze')->nullable();          // Link Waze

            // Acesso
            $table->boolean('aberto_publico')->default(false); // Aberto ao público geral?
            $table->string('link_inscricao')->nullable();      // Link para inscrição

            // Controle
            $table->boolean('publicado')->default(true);       // Exibir no site?
            $table->boolean('destaque')->default(false);       // Destacar na home?

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
