<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ficha do Aluno: ') . $aluno->nome }}
            </h2>
            <div class="flex items-center space-x-3">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('alunos.edit', $aluno) }}" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                        Editar Aluno
                    </a>
                @endif
                <a href="{{ route('alunos.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card de Dados Gerais do Aluno -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informações Pessoais e Acadêmicas</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome Completo</span>
                        <span class="text-base font-bold text-gray-800">{{ $aluno->nome }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Matrícula</span>
                        <span class="text-base font-bold font-mono text-gray-800">{{ $aluno->matricula }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Turma</span>
                        <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-[#236B25]">
                            {{ $aluno->turma->nome ?? 'Sem Turma' }}
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Data de Nascimento</span>
                        <span class="text-sm font-semibold text-gray-700">
                            {{ $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : 'Não informada' }}
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">E-mail do Responsável</span>
                        <span class="text-sm font-semibold text-gray-700">{{ $aluno->email_responsavel }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Telefone do Responsável</span>
                        <span class="text-sm font-semibold text-gray-700">{{ $aluno->telefone_responsavel ?? 'Não informado' }}</span>
                    </div>
                </div>
            </div>

            <!-- Card de Resumo Disciplinar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Situação Disciplinar</h3>
                    <p class="text-sm text-gray-600 mt-0.5">Histórico de advertências e orientações registradas para este estudante.</p>
                </div>
                <div>
                    <span class="px-4 py-2 rounded-full text-sm font-extrabold bg-red-100 text-red-800 border border-red-200">
                        {{ $aluno->ocorrencias->count() }} {{ Str::plural('ocorrência', $aluno->ocorrencias->count()) }}
                    </span>
                </div>
            </div>

            <!-- Tabela com Histórico Detalhado de Ocorrências -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Ocorrências do Aluno</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Infração / Título</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Gravidade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data da Ocorrência</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($aluno->ocorrencias as $ocorrencia)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                        {{ $ocorrencia->titulo }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($ocorrencia->gravidade == 'baixa')
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">Leve</span>
                                        @elseif($ocorrencia->gravidade == 'media')
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Média</span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Grave</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($ocorrencia->data_ocorrencia)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('ocorrencias.show', $ocorrencia) }}" class="text-[#329835] hover:text-[#236B25] font-semibold underline-offset-2 hover:underline">
                                            Ver Ficha &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Este aluno não possui nenhuma ocorrência cadastrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>