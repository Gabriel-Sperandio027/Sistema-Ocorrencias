<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Métricas Gerais
        $totalOcorrencias = Ocorrencia::count();
        $totalAlunos      = Aluno::count();
        $totalTurmas      = Turma::count();

        // 2. Ocorrências por Gravidade
        $ocorrenciasLeves  = Ocorrencia::where('gravidade', 'baixa')->count();
        $ocorrenciasMedias = Ocorrencia::where('gravidade', 'media')->count();
        $ocorrenciasGraves = Ocorrencia::where('gravidade', 'alta')->count();

        // 3. Turma com maior número de ocorrências acumuladas
        $turmaMaisOcorrencias = Turma::withCount('ocorrencias')
            ->orderByDesc('ocorrencias_count')
            ->first();

        // 4. Últimas 5 ocorrências registradas
        $recentes = Ocorrencia::with(['aluno.turma', 'user'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalOcorrencias',
            'totalAlunos',
            'totalTurmas',
            'ocorrenciasLeves',
            'ocorrenciasMedias',
            'ocorrenciasGraves',
            'turmaMaisOcorrencias',
            'recentes'
        ));
    }
}