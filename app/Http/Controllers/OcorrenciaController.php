<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use App\Models\Aluno;
use App\Models\Turma;
use App\Mail\OcorrenciaRegistradaMail; // Mailable do e-mail de notificação
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OcorrenciaController extends Controller
{
    /**
     * Exibe a lista paginada de ocorrências.
     */
    public function index()
    {
        $ocorrencias = Ocorrencia::with(['aluno.turma', 'user'])
            ->latest('data_ocorrencia')
            ->latest('created_at')
            ->paginate(10);

        return view('ocorrencias.index', compact('ocorrencias'));
    }

    /**
     * Exibe o formulário de cadastro de ocorrências enviando Alunos e Turmas.
     */
    public function create()
    {
        $turmas = Turma::orderBy('nome', 'asc')->get();
        $alunos = Aluno::with('turma')->orderBy('nome', 'asc')->get();

        return view('ocorrencias.create', compact('alunos', 'turmas'));
    }

    /**
     * Armazena uma nova ocorrência no banco de dados e envia e-mail ao responsável.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aluno_id'        => 'required|exists:alunos,id',
            'titulo'          => 'required|string|max:255',
            'gravidade'       => 'required|in:baixa,media,alta',
            'data_ocorrencia' => 'required|date',
            'descricao'       => 'required|string',
        ]);

        // Vincula o usuário logado que está registrando a ocorrência
        $validated['user_id'] = auth()->id();

        $ocorrencia = Ocorrencia::create($validated);

        // Se o checkbox de notificar estiver marcado, dispara o e-mail para o responsável
        if ($request->has('notificar_responsavel') && $ocorrencia->aluno && $ocorrencia->aluno->email_responsavel) {
            try {
                Mail::to($ocorrencia->aluno->email_responsavel)
                    ->send(new OcorrenciaRegistradaMail($ocorrencia));
                
                $msgSucesso = 'Ocorrência registrada com sucesso e e-mail enviado ao responsável!';
            } catch (\Exception $e) {
                // Em caso de falha de conexão SMTP/envio, salva o registro mas avisa sobre a falha do e-mail
                $msgSucesso = 'Ocorrência registrada com sucesso! Porém, houve uma falha ao enviar o e-mail de notificação.';
            }
        } else {
            $msgSucesso = 'Ocorrência registrada com sucesso!';
        }

        return redirect()->route('ocorrencias.index')->with('success', $msgSucesso);
    }

    /**
     * Exibe a ficha detalhada de uma ocorrência específica.
     */
    public function show(Ocorrencia $ocorrencia)
    {
        $ocorrencia->load(['aluno.turma', 'user']);

        return view('ocorrencias.show', compact('ocorrencia'));
    }

    /**
     * Exibe o formulário de edição de uma ocorrência.
     */
    public function edit(Ocorrencia $ocorrencia)
    {
        $turmas = Turma::orderBy('nome', 'asc')->get();
        $alunos = Aluno::with('turma')->orderBy('nome', 'asc')->get();

        return view('ocorrencias.edit', compact('ocorrencia', 'alunos', 'turmas'));
    }

    /**
     * Atualiza os dados da ocorrência no banco de dados.
     */
    public function update(Request $request, Ocorrencia $ocorrencia)
    {
        $validated = $request->validate([
            'aluno_id'        => 'required|exists:alunos,id',
            'titulo'          => 'required|string|max:255',
            'gravidade'       => 'required|in:baixa,media,alta',
            'data_ocorrencia' => 'required|date',
            'descricao'       => 'required|string',
        ]);

        $ocorrencia->update($validated);

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência atualizada com sucesso!');
    }

    /**
     * Remove uma ocorrência do banco de dados.
     */
    public function destroy(Ocorrencia $ocorrencia)
    {
        $ocorrencia->delete();

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência excluída com sucesso!');
    }
}