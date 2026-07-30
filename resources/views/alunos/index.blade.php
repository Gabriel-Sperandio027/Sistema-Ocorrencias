<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciamento de Alunos') }}
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

                    <!-- Cabeçalho com Título, Campo de Busca e Botão Novo Aluno -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-lg font-medium text-gray-900">Lista de Alunos Cadastrados</h3>

                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <!-- Formulário de Busca -->
                            <form method="GET" action="{{ route('alunos.index') }}" class="flex items-center space-x-2 w-full md:w-auto">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}" 
                                    placeholder="Buscar por nome ou matrícula..." 
                                    class="text-sm rounded-md border-gray-300 shadow-sm focus:border-[#329835] focus:ring-[#329835] w-full md:w-64"
                                >
                                <button type="submit" class="px-3 py-2 bg-gray-800 text-white rounded-md text-xs font-semibold uppercase hover:bg-gray-700 transition duration-150">
                                    Buscar
                                </button>

                                @if(request('search'))
                                    <a href="{{ route('alunos.index') }}" class="text-xs text-gray-500 hover:text-gray-700 underline">
                                        Limpar
                                    </a>
                                @endif
                            </form>

                            <!-- Exibe o botão de criar aluno APENAS para Administradores -->
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('alunos.create') }}" class="inline-flex items-center px-4 py-2 bg-[#329835] hover:bg-[#236B25] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition duration-150 ease-in-out whitespace-nowrap">
                                    + Novo Aluno
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turma</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Nasc.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail Resp.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tel. Resp.</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($alunos as $aluno)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <!-- Matrícula -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-mono">
                                            {{ $aluno->matricula }}
                                        </td>

                                        <!-- Nome -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">
                                            {{ $aluno->nome }}
                                        </td>

                                        <!-- Turma -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-[#236B25]">
                                                {{ $aluno->turma->nome ?? 'Sem Turma' }}
                                            </span>
                                        </td>

                                        <!-- Data de Nascimento Formatada -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : '-' }}
                                        </td>

                                        <!-- E-mail do Responsável -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $aluno->email_responsavel }}
                                        </td>

                                        <!-- Telefone do Responsável -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $aluno->telefone_responsavel ?? '-' }}
                                        </td>

                                        <!-- Ações -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <!-- Ver (Disponível para TODOS) -->
                                            <a href="{{ route('alunos.show', $aluno) }}" class="text-[#329835] hover:text-[#236B25] mr-2 font-semibold">Ver</a>

                                            <!-- Editar e Excluir (Apenas Admin) -->
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('alunos.edit', $aluno) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 font-semibold">Editar</a>

                                                <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja realmente excluir este aluno?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Excluir</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                            @if(request('search'))
                                                Nenhum aluno encontrado para a busca "{{ request('search') }}".
                                            @else
                                                Nenhum aluno cadastrado até o momento.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $alunos->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>