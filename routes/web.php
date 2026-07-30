<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de Turmas (CRUD Completo)
    Route::resource('turmas', TurmaController::class);
    Route::resource('alunos', AlunoController::class);
    Route::resource('ocorrencias', OcorrenciaController::class);

    // Grupo do Administrador
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

});

require __DIR__.'/auth.php';