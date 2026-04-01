<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de membros da ARLS Ferraz de Vasconcelos.
     *
     * Observações importantes:
     * - O CIM (Cadastro de Irmão Maçom) é o mesmo número usado no GOSP,
     *   portanto não existe campo separado para cim_gosp.
     * - SoftDeletes é usado para nunca excluir fisicamente um irmão,
     *   apenas arquivá-lo — preservando o histórico.
     * - Os campos de acesso ao sistema (senha, acesso_ativo) serão
     *   utilizados na Fase 2 (área restrita dos membros).
     */
    public function up(): void
    {
        Schema::create('membros', function (Blueprint $table) {

            $table->id();

            // ── Dados Maçônicos ──────────────────────────────────────

            // CIM: Cadastro de Irmão Maçom — número único no GOSP
            $table->string('cim', 50)->unique()->nullable();

            // Nome escolhido pelo irmão dentro da Maçonaria
            $table->string('nome_maconico', 100)->nullable();

            // Grau maçônico: 1=Aprendiz, 2=Companheiro, 3=Mestre
            $table->tinyInteger('grau')->unsigned()->default(1);

            // Cargo que o irmão exerce atualmente na diretoria da loja
            $table->string('cargo_atual', 100)->nullable();

            // Data em que o irmão foi iniciado (tornou-se Aprendiz)
            $table->date('data_iniciacao')->nullable();

            // Data em que foi elevado ao 2° grau (Companheiro)
            $table->date('data_elevacao')->nullable();

            // Data em que foi exaltado ao 3° grau (Mestre)
            $table->date('data_exaltacao')->nullable();

            // Data em que se filiou a esta loja especificamente
            $table->date('data_filiacao_loja')->nullable();

            // Nome da loja de origem (preenchido apenas se veio transferido)
            $table->string('loja_origem', 150)->nullable();

            // Situação atual do irmão na loja
            $table->enum('situacao', [
                'ativo',        // Irmão regular e em dia
                'inativo',      // Sem participação ativa
                'suspenso',     // Suspenso por decisão da loja
                'remido',       // Dispensado de mensalidade por tempo de serviço
                'benemerito',   // Título honorífico concedido pela loja
                'fundador',     // Membro fundador da loja
                'transferido',  // Transferido para outra loja
                'falecido',     // In memoriam
            ])->default('ativo');

            // Categoria do membro: efetivo, honorario ou correspondente
            $table->string('tipo_membro', 50)->default('efetivo');

            // ── Dados Pessoais ───────────────────────────────────────

            // Nome completo do irmão — campo obrigatório
            $table->string('nome_completo', 200);

            // Nome civil conforme consta no RG (pode diferir do nome maçônico)
            $table->string('nome_civil', 200)->nullable();

            // Caminho da foto armazenada em storage/app/public/membros/
            $table->string('foto')->nullable();

            // Data de nascimento — usada para felicitações automáticas (Fase 2)
            $table->date('data_nascimento')->nullable();

            // Cidade onde o irmão nasceu
            $table->string('naturalidade', 100)->nullable();

            // Nacionalidade do irmão
            $table->string('nacionalidade', 100)->default('Brasileiro');

            // CPF — único no sistema, sem formatação (apenas dígitos e máscara)
            $table->string('cpf', 14)->unique()->nullable();

            // Número do RG
            $table->string('rg', 20)->nullable();

            // Órgão expedidor do RG (ex: SSP-SP, DETRAN-SP)
            $table->string('orgao_expedidor', 20)->nullable();

            // Número do título de eleitor
            $table->string('titulo_eleitor', 20)->nullable();

            // Profissão do irmão
            $table->string('profissao', 100)->nullable();

            // Nível de escolaridade
            $table->string('escolaridade', 100)->nullable();

            // Estado civil atual do irmão
            $table->enum('estado_civil', [
                'solteiro',
                'casado',
                'divorciado',
                'viuvo',
                'uniao_estavel',
            ])->nullable();

            // ── Contato ──────────────────────────────────────────────

            // E-mail principal — único no sistema, usado para comunicações oficiais
            $table->string('email', 150)->unique()->nullable();

            // E-mail alternativo/secundário para contato de backup
            $table->string('email_alternativo', 150)->nullable();

            // Telefone fixo residencial ou comercial
            $table->string('telefone', 20)->nullable();

            // Número do celular
            $table->string('celular', 20)->nullable();

            // Número do WhatsApp (pode ser diferente do celular)
            $table->string('whatsapp', 20)->nullable();

            // ── Endereço ─────────────────────────────────────────────

            // CEP do endereço residencial
            $table->string('cep', 10)->nullable();

            // Nome da rua, avenida, travessa, etc.
            $table->string('logradouro', 200)->nullable();

            // Número do imóvel
            $table->string('numero', 10)->nullable();

            // Complemento do endereço (apto, bloco, casa, etc.)
            $table->string('complemento', 100)->nullable();

            // Bairro do endereço
            $table->string('bairro', 100)->nullable();

            // Cidade do endereço
            $table->string('cidade', 100)->nullable();

            // UF — sigla do estado com 2 caracteres (ex: SP, RJ)
            $table->string('estado', 2)->nullable();

            // ── Acesso ao sistema — Fase 2 ───────────────────────────

            // Senha para acesso à área restrita dos membros (Fase 2)
            $table->string('senha')->nullable();

            // Indica se o acesso do irmão ao sistema está habilitado
            $table->boolean('acesso_ativo')->default(false);

            // Registro do último acesso do irmão ao sistema
            $table->timestamp('ultimo_acesso')->nullable();

            // ── Controle ─────────────────────────────────────────────

            // Define se o irmão aceita receber e-mails automáticos
            // (felicitações de aniversário, comunicados da loja, etc.)
            $table->boolean('recebe_email')->default(true);

            // Observações internas sobre o irmão (não exibidas publicamente)
            $table->text('observacoes')->nullable();

            // Timestamps automáticos: created_at e updated_at
            $table->timestamps();

            // SoftDelete: preenche deleted_at ao invés de excluir fisicamente
            // Garante que o histórico do irmão seja preservado para sempre
            $table->softDeletes();
        });
    }

    /**
     * Desfaz a criação da tabela membros.
     * Usado apenas em ambiente de desenvolvimento com migrate:rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};
