<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Painel de Controle') }}
            </h2>
            @if(auth()->user()->isAdmin())
                <span class="px-3 py-1 bg-green-100 text-[#236B25] text-xs font-bold rounded-full uppercase">
                    Administrador
                </span>
            @else
                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full uppercase">
                    Servidor / Pedagógico
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Mensagem de Boas-Vindas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-[#329835]">
                <h3 class="text-lg font-bold text-gray-800">
                    Olá, {{ auth()->user()->name }}!
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Bem-vindo ao Sistema de Gerenciamento de Ocorrências do IFES Campus Alegre. Confira o resumo das atividades abaixo.
                </p>
            </div>

            <!-- CARDS DE MÉTRICAS GERAIS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total de Ocorrências (Verde IFES) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between border-l-4 border-[#329835]">
                    <div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total de Ocorrências</span>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalOcorrencias }}</p>
                    </div>
                    <div class="p-3 bg-green-100 text-[#236B25] rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Total de Alunos (Azul) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between border-l-4 border-blue-500">
                    <div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Alunos Cadastrados</span>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalAlunos }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Total de Turmas (Roxo) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between border-l-4 border-purple-500">
                    <div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Turmas Ativas</span>
                        <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalTurmas }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0v5"></path>
                        </svg>
                    </div>
                </div>

                <!-- Maior Índice (Laranja/Amber) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between border-l-4 border-amber-500">
                    <div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Maior Índice</span>
                        @if(isset($turmaMaisOcorrencias) && $turmaMaisOcorrencias->ocorrencias_count > 0)
                            <p class="text-lg font-extrabold text-gray-900 mt-1 truncate max-w-[140px]" title="{{ $turmaMaisOcorrencias->nome }}">
                                {{ $turmaMaisOcorrencias->nome }}
                            </p>
                            <span class="text-xs font-semibold text-amber-700">
                                {{ $turmaMaisOcorrencias->ocorrencias_count }} {{ Str::plural('registro', $turmaMaisOcorrencias->ocorrencias_count) }}
                            </span>
                        @else
                            <p class="text-sm font-semibold text-gray-400 mt-1">Sem registros</p>
                        @endif
                    </div>
                    <div class="p-3 bg-amber-100 text-amber-700 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- CARDS DE GRAVIDADE DAS OCORRÊNCIAS -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-base font-bold text-gray-800 mb-4 border-b pb-2">Distribuição por Gravidade</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Leves -->
                    <div class="p-4 rounded-lg bg-green-50 border border-green-200 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-green-800 uppercase">Leves / Orientação</span>
                            <p class="text-2xl font-bold text-green-700 mt-1">{{ $ocorrenciasLeves }}</p>
                        </div>
                        <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-xs font-bold">Leve</span>
                    </div>

                    <!-- Médias -->
                    <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-200 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-yellow-800 uppercase">Médias / Advertência</span>
                            <p class="text-2xl font-bold text-yellow-700 mt-1">{{ $ocorrenciasMedias }}</p>
                        </div>
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-xs font-bold">Média</span>
                    </div>

                    <!-- Graves -->
                    <div class="p-4 rounded-lg bg-red-50 border border-red-200 flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-red-800 uppercase">Graves / Reunião</span>
                            <p class="text-2xl font-bold text-red-700 mt-1">{{ $ocorrenciasGraves }}</p>
                        </div>
                        <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-xs font-bold">Grave</span>
                    </div>
                </div>
            </div>

            <!-- TABELA DE OCORRÊNCIAS RECENTES -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h3 class="text-base font-bold text-gray-800">Últimas Ocorrências Registradas</h3>
                    <a href="{{ route('ocorrencias.index') }}" class="text-xs font-bold text-[#329835] hover:text-[#236B25] uppercase tracking-wider">
                        Ver todas &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turma</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Infração</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Gravidade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentes as $ocorrencia)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $ocorrencia->aluno->nome ?? 'Aluno Removido' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $ocorrencia->aluno->turma->nome ?? 'Sem Turma' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ Str::limit($ocorrencia->titulo, 35) }}
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
                                        <a href="{{ route('ocorrencias.show', $ocorrencia) }}" class="text-[#329835] hover:text-[#236B25] font-semibold">
                                            Ver Ficha
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Nenhuma ocorrência registrada até o momento.
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