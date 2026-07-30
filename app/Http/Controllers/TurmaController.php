<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        // Carrega as turmas trazendo a contagem automática de alunos cadastrados
        $turmas = Turma::withCount('alunos')
            ->latest()
            ->paginate(10);

        return view('turmas.index', compact('turmas'));
    }

    public function create()
    {
        // Trava para impedir Servidor de acessar a tela de cadastro
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('turmas.index')->with('error', 'Apenas administradores podem cadastrar turmas.');
        }

        return view('turmas.create');
    }

    public function store(Request $request)
    {
        // Trava para impedir Servidor de salvar uma nova turma
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('turmas.index')->with('error', 'Apenas administradores podem cadastrar turmas.');
        }

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'ano_letivo' => ['required', 'string', 'max:4'],
        ]);

        Turma::create($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma cadastrada com sucesso!');
    }

    public function edit(Turma $turma)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('turmas.index')->with('error', 'Apenas administradores podem editar turmas.');
        }

        return view('turmas.edit', compact('turma'));
    }

    public function update(Request $request, Turma $turma)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('turmas.index')->with('error', 'Apenas administradores podem atualizar turmas.');
        }

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'curso' => ['required', 'string', 'max:255'],
            'ano_letivo' => ['required', 'string', 'max:4'],
        ]);

        $turma->update($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('turmas.index')->with('error', 'Apenas administradores podem excluir turmas.');
        }

        $turma->delete();
        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }

    /**
     * Exibe os detalhes de uma turma específica.
     */
    public function show(Turma $turma)
    {
        // Carrega os alunos da turma
        $turma->load('alunos');

        return view('turmas.show', compact('turma'));
    }
}