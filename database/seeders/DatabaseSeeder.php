<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Turma;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar Usuário Administrador
        User::create([
            'name' => 'Administrador Geral',
            'email' => 'admin@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // 2. Criar Turma de Exemplo
        Turma::create([
            'nome' => '1º Ano A',
            'curso' => 'Técnico em Informática',
            'ano_letivo' => '2026',
            'turno' => 'Integral',
        ]);
    }
}