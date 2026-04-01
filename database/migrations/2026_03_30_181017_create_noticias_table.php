<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ============================================================
     * CRIAÇÃO DA TABELA DE NOTÍCIAS
     * ============================================================
     */
    public function up(): void
    {
        Schema::create('noticias', function (Blueprint $table) {

            $table->id();

            /**
             * TÍTULO DA NOTÍCIA
             */
            $table->string('titulo');

            /**
             * SLUG (URL AMIGÁVEL)
             * Ex: minha-noticia-importante
             */
            $table->string('slug')->unique();

            /**
             * RESUMO (EXIBIDO NA LISTAGEM)
             */
            $table->text('resumo')->nullable();

            /**
             * CONTEÚDO COMPLETO (HTML DO EDITOR)
             */
            $table->longText('conteudo');

            /**
             * IMAGEM DE CAPA
             */
            $table->string('foto_capa')->nullable();

            /**
             * STATUS DE PUBLICAÇÃO
             */
            $table->boolean('publicado')->default(false);

            /**
             * DATA DE PUBLICAÇÃO
             */
            $table->timestamp('publicado_em')->nullable();

            /**
             * NOVO: CATEGORIA DA NOTÍCIA
             */
            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /**
             * NOVO: CONTADOR DE VISUALIZAÇÕES
             */
            $table->unsignedInteger('views')->default(0);

            /**
             * NOVO: NOTÍCIA EM DESTAQUE
             */
            $table->boolean('destaque')->default(false);

            /**
             * AUTOR (USUÁRIO)
             */
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            /**
             * CREATED_AT e UPDATED_AT
             */
            $table->timestamps();
        });
    }

    /**
     * ============================================================
     * REMOÇÃO DA TABELA
     * ============================================================
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
