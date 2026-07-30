<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes da Turma: ') . $turma->nome }}
            </h2>
            <div class="flex items-center space-x-3">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('turmas.edit', $turma) }}" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                        Editar Turma
                    </a>
                @endif
                <a href="{{ route('turmas.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Informações Gerais da Turma -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informações da Turma</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome da Turma</span>
                        <span class="text-base font-bold text-gray-800">{{ $turma->nome }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Curso</span>
                        <span class="text-base font-bold text-gray-800">{{ $turma->curso }}</span>
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Ano Letivo</span>
                        <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-[#236B25]">
                            {{ $turma->ano_letivo }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Lista de Alunos Matriculados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="text-lg font-medium text-gray-900">Alunos Integrantes</h3>
                    <span class="text-xs font-semibold text-[#236B25] bg-green-50 px-3 py-1 rounded-full border border-green-200">
                        Total: {{ $turma->alunos->count() }} aluno(s)
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail do Responsável</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($turma->alunos as $aluno)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $aluno->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $aluno->matricula }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $aluno->email_responsavel ?? 'Não informado' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('alunos.show', $aluno) }}" class="text-[#329835] hover:text-[#236B25] font-semibold underline-offset-2 hover:underline">
                                            Ver Aluno &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Nenhum aluno cadastrado nesta turma ainda.
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