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
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id();
            
            // Relacionamentos com Aluno e Usuário (quem registrou)
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            
            $table->string('titulo');              // Infração selecionada
            $table->string('gravidade')->default('baixa'); // 👈 Adicionada a coluna gravidade ('baixa', 'media', 'alta')
            $table->string('tipo')->nullable();    // Mantida para compatibilidade
            $table->text('descricao');            // Detalhamento do ocorrido
            
            $table->date('data_ocorrencia');       // Data do fato
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocorrencias');
    }
};