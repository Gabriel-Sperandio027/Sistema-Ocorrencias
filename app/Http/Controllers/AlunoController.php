<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $query = Aluno::with('turma');

        // Filtra por Nome ou Matrícula se o usuário preencheu o campo de busca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('matricula', 'like', "%{$search}%");
            });
        }

        // Mantém a consulta na paginação
        $alunos = $query->latest()->paginate(10)->appends($request->query());

        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('alunos.index')->with('error', 'Apenas administradores podem cadastrar alunos.');
        }

        $turmas = Turma::orderBy('nome')->get();
        return view('alunos.create', compact('turmas'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('alunos.index')->with('error', 'Apenas administradores podem cadastrar alunos.');
        }

        $request->validate([
            'nome'                 => ['required', 'string', 'max:255'],
            'email'                => ['nullable', 'email', 'max:255'],
            'email_responsavel'    => ['required', 'email', 'max:255'],
            'telefone_responsavel' => ['nullable', 'string', 'max:20'],
            'turma_id'             => ['required', 'exists:turmas,id'],
            'data_nascimento'      => ['nullable', 'string'],
            'matricula'            => ['required', 'string', 'max:50', 'unique:alunos,matricula'],
        ]);

        $data = $request->all();

        if (!empty($data['data_nascimento'])) {
            try {
                if (str_contains($data['data_nascimento'], '/')) {
                    $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])->format('Y-m-d');
                } else {
                    $data['data_nascimento'] = Carbon::parse($data['data_nascimento'])->format('Y-m-d');
                }
            } catch (\Exception $e) {
                $data['data_nascimento'] = null;
            }
        }

        Aluno::create($data);

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show(Aluno $aluno)
    {
        // Carrega a turma e o histórico de ocorrências ordenado por data
        $aluno->load(['turma', 'ocorrencias' => function ($query) {
            $query->latest('data_ocorrencia');
        }]);

        return view('alunos.show', compact('aluno'));
    }

    public function edit(Aluno $aluno)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('alunos.index')->with('error', 'Apenas administradores podem editar alunos.');
        }

        $turmas = Turma::orderBy('nome')->get();
        return view('alunos.edit', compact('aluno', 'turmas'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('alunos.index')->with('error', 'Apenas administradores podem atualizar alunos.');
        }

        $request->validate([
            'nome'                 => ['required', 'string', 'max:255'],
            'email'                => ['nullable', 'email', 'max:255'],
            'email_responsavel'    => ['required', 'email', 'max:255'],
            'telefone_responsavel' => ['nullable', 'string', 'max:20'],
            'turma_id'             => ['required', 'exists:turmas,id'],
            'data_nascimento'      => ['nullable', 'string'],
            'matricula'            => ['required', 'string', 'max:50', 'unique:alunos,matricula,' . $aluno->id],
        ]);

        $data = $request->all();

        if (!empty($data['data_nascimento'])) {
            try {
                if (str_contains($data['data_nascimento'], '/')) {
                    $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])->format('Y-m-d');
                } else {
                    $data['data_nascimento'] = Carbon::parse($data['data_nascimento'])->format('Y-m-d');
                }
            } catch (\Exception $e) {
                $data['data_nascimento'] = null;
            }
        }

        $aluno->update($data);

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy(Aluno $aluno)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('alunos.index')->with('error', 'Apenas administradores podem excluir alunos.');
        }

        $aluno->delete();
        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}