<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');       // Ex: 1º Ano A
            $table->string('curso');      // Ex: Informática
            $table->string('ano_letivo'); // Ex: 2026
            $table->string('turno')->nullable(); // Ex: Matutino, Vespertino, Integral
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};