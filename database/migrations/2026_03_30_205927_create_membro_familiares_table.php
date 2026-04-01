<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membro_familiares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membro_id')->constrained('membros')->onDelete('cascade');
            $table->enum('parentesco', ['esposa', 'filho', 'filha', 'enteado', 'enteada']);
            $table->string('nome');
            $table->date('data_nascimento')->nullable();
            $table->date('data_casamento')->nullable();     // Só para esposa
            $table->string('email')->nullable();            // Para envio de felicitações
            $table->string('telefone')->nullable();
            $table->boolean('recebe_felicitacao')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membro_familiares');
    }
};
