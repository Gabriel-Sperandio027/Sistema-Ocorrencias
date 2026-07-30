<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ficha de Ocorrência') }}
            </h2>
            <a href="{{ route('ocorrencias.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center border-b pb-4 mb-6">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Ocorrência #{{ $ocorrencia->id }}</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-1">{{ $ocorrencia->titulo }}</h3>
                    </div>

                    <div>
                        @if($ocorrencia->gravidade === 'baixa' || $ocorrencia->gravidade === 'leve')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 uppercase">Leve</span>
                        @elseif($ocorrencia->gravidade === 'media')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 uppercase">Média</span>
                        @elseif($ocorrencia->gravidade === 'alta' || $ocorrencia->gravidade === 'grave')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 uppercase">Grave</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800 uppercase">{{ $ocorrencia->gravidade }}</span>
                        @endif
                    </div>
                </div>

                <!-- Dados do Aluno -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-4 rounded-lg mb-6">
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Aluno</span>
                        <a href="{{ route('alunos.show', $ocorrencia->aluno) }}" class="text-base font-bold text-[#329835] hover:underline">
                            {{ $ocorrencia->aluno->nome }}
                        </a>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Matrícula</span>
                        <span class="text-base font-semibold text-gray-800">{{ $ocorrencia->aluno->matricula }}</span>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Turma</span>
                        <span class="text-base font-semibold text-gray-800">{{ $ocorrencia->aluno->turma->nome ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Detalhes do Registro -->
                <div class="space-y-4 mb-6">
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase">Data do Fato</span>
                        <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($ocorrencia->data_ocorrencia)->format('d/m/Y') }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Observações e Detalhes Registrados</span>
                        <div class="p-4 bg-gray-50 rounded-lg text-gray-700 leading-relaxed whitespace-pre-line border border-gray-200">
                            {{ $ocorrencia->descricao }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t text-sm">
                        <div>
                            <span class="block text-xs text-gray-500">E-mail do Responsável Notificado:</span>
                            <span class="font-semibold text-gray-800">{{ $ocorrencia->aluno->email_responsavel }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-500">Registrado por:</span>
                            <span class="font-semibold text-gray-800">{{ $ocorrencia->user->name ?? 'Servidor do Sistema' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Ações do Administrador -->
                @if(auth()->user()->isAdmin())
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <a href="{{ route('ocorrencias.edit', $ocorrencia) }}" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition">
                            Editar Registro
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>