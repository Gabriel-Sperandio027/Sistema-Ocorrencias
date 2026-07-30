<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciamento de Ocorrências') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Histórico de Ocorrências</h3>
                        <a href="{{ route('ocorrencias.create') }}" class="inline-flex items-center px-4 py-2 bg-[#329835] hover:bg-[#236B25] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition duration-150 ease-in-out">
                            + Nova Ocorrência
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Turma</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título / Infração</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gravidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($ocorrencias as $ocorrencia)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $ocorrencia->aluno->nome }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $ocorrencia->aluno->turma->nome ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ Str::limit($ocorrencia->titulo, 35) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($ocorrencia->gravidade === 'baixa' || $ocorrencia->gravidade === 'leve')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">Leve</span>
                                            @elseif($ocorrencia->gravidade === 'media')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Média</span>
                                            @elseif($ocorrencia->gravidade === 'alta' || $ocorrencia->gravidade === 'grave')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">Grave</span>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">{{ ucfirst($ocorrencia->gravidade) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($ocorrencia->data_ocorrencia)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('ocorrencias.show', $ocorrencia) }}" class="text-[#329835] hover:text-[#236B25] mr-2 font-semibold">Ver</a>
                                            
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('ocorrencias.edit', $ocorrencia) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 font-semibold">Editar</a>
                                                <form action="{{ route('ocorrencias.destroy', $ocorrencia) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir esta ocorrência?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Excluir</button>
                                                </form>
                                            @endif
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

                    <div class="mt-4">
                        {{ $ocorrencias->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>