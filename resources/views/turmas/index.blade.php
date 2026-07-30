<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciamento de Turmas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Lista de Turmas Cadastradas</h3>
                        
                        <!-- Exibe o botão de criar turma APENAS para Administradores -->
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('turmas.create') }}" class="inline-flex items-center px-4 py-2 bg-[#329835] hover:bg-[#236B25] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition duration-150 ease-in-out">
                                + Nova Turma
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome da Turma</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total de Alunos</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ano Letivo</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($turmas as $turma)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $turma->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $turma->curso }}</td>
                                        
                                        <!-- Nova Coluna com Contagem de Alunos -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $turma->alunos_count }} {{ Str::plural('aluno', $turma->alunos_count) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-[#236B25]">
                                                {{ $turma->ano_letivo }}
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <!-- Visualizar (Disponível para TODOS os usuários) -->
                                            <a href="{{ route('turmas.show', $turma) }}" class="text-[#329835] hover:text-[#236B25] mr-2 font-semibold">Ver</a>

                                            <!-- Editar e Excluir (Apenas Admin) -->
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('turmas.edit', $turma) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 font-semibold">Editar</a>

                                                <form action="{{ route('turmas.destroy', $turma) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja realmente excluir esta turma?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Excluir</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Nenhuma turma cadastrada até o momento.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $turmas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>