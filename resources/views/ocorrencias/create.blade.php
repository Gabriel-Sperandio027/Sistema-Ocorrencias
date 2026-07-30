<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nova Ocorrência') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('ocorrencias.store') }}" method="POST">
                    @csrf

                    <!-- Filtro por Turma -->
                    <div class="mb-4">
                        <x-input-label for="turma_filter" :value="__('Filtrar Alunos por Turma')" />
                        <select id="turma_filter" class="block mt-1 w-full border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm">
                            <option value="">Todas as Turmas</option>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seleção de Aluno -->
                    <div class="mb-4">
                        <x-input-label for="aluno_id" :value="__('Aluno')" />
                        <select id="aluno_id" name="aluno_id" class="block mt-1 w-full border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm" required>
                            <option value="">Selecione um aluno...</option>
                            @foreach($alunos as $aluno)
                                <option value="{{ $aluno->id }}" 
                                        data-turma="{{ $aluno->turma_id }}" 
                                        {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                                    {{ $aluno->nome }} - Matrícula: {{ $aluno->matricula }} ({{ $aluno->turma->nome ?? 'Sem Turma' }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('aluno_id')" class="mt-2" />
                    </div>

                    <!-- Seleção da Infração -->
                    <div class="mb-4">
                        <x-input-label for="titulo" :value="__('Infração Cometida')" />
                        <select id="titulo" name="titulo" class="block mt-1 w-full border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm" required>
                            <option value="">Selecione a infração...</option>
                            
                            <optgroup label="Infrações Leves">
                                <option value="Uso indevido de celular em sala" data-gravidade="baixa" {{ old('titulo') == 'Uso indevido de celular em sala' ? 'selected' : '' }}>Uso indevido de celular em sala</option>
                                <option value="Atraso injustificado" data-gravidade="baixa" {{ old('titulo') == 'Atraso injustificado' ? 'selected' : '' }}>Atraso injustificado para a aula</option>
                                <option value="Ausência de uniforme escolar" data-gravidade="baixa" {{ old('titulo') == 'Ausência de uniforme escolar' ? 'selected' : '' }}>Ausência de uniforme escolar</option>
                                <option value="Perturbação da aula / Conversa paralela" data-gravidade="baixa" {{ old('titulo') == 'Perturbação da aula / Conversa paralela' ? 'selected' : '' }}>Perturbação da aula / Conversa paralela</option>
                            </optgroup>

                            <optgroup label="Infrações Médias">
                                <option value="Desrespeito a servidor ou professor" data-gravidade="media" {{ old('titulo') == 'Desrespeito a servidor ou professor' ? 'selected' : '' }}>Desrespeito a servidor ou professor</option>
                                <option value="Saída do campus sem autorização" data-gravidade="media" {{ old('titulo') == 'Saída do campus sem autorização' ? 'selected' : '' }}>Saída do campus sem autorização</option>
                                <option value="Dano leve ao patrimônio público" data-gravidade="media" {{ old('titulo') == 'Dano leve ao patrimônio público' ? 'selected' : '' }}>Dano leve ao patrimônio público</option>
                            </optgroup>

                            <optgroup label="Infrações Graves">
                                <option value="Agressão verbal ou física" data-gravidade="alta" {{ old('titulo') == 'Agressão verbal ou física' ? 'selected' : '' }}>Agressão verbal ou física</option>
                                <option value="Porte/Uso de substâncias não permitidas" data-gravidade="alta" {{ old('titulo') == 'Porte/Uso de substâncias não permitidas' ? 'selected' : '' }}>Porte/Uso de substâncias não permitidas</option>
                                <option value="Reincidência grave de indisciplina" data-gravidade="alta" {{ old('titulo') == 'Reincidência grave de indisciplina' ? 'selected' : '' }}>Reincidência grave de indisciplina</option>
                            </optgroup>
                        </select>
                        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                    </div>

                    <!-- Nível de Gravidade -->
                    <div class="mb-4">
                        <x-input-label for="gravidade" :value="__('Nível de Gravidade')" />
                        <select id="gravidade" name="gravidade" class="block mt-1 w-full border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm" required>
                            <option value="baixa" {{ old('gravidade', 'baixa') == 'baixa' ? 'selected' : '' }}>Leve / Orientação</option>
                            <option value="media" {{ old('gravidade') == 'media' ? 'selected' : '' }}>Média / Advertência</option>
                            <option value="alta" {{ old('gravidade') == 'alta' ? 'selected' : '' }}>Grave / Reunião com Responsável</option>
                        </select>
                        <x-input-error :messages="$errors->get('gravidade')" class="mt-2" />
                    </div>

                    <!-- Data da Ocorrência -->
                    <div class="mb-4">
                        <x-input-label for="data_ocorrencia" :value="__('Data da Ocorrência')" />
                        <x-text-input id="data_ocorrencia" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="date" name="data_ocorrencia" :value="old('data_ocorrencia', date('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('data_ocorrencia')" class="mt-2" />
                    </div>

                    <!-- Descrição Detalhada -->
                    <div class="mb-4">
                        <x-input-label for="descricao" :value="__('Observações e Detalhes dos Fatos')" />
                        <textarea id="descricao" name="descricao" rows="4" class="block mt-1 w-full border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm" placeholder="Descreva detalhes específicos do ocorrido..." required>{{ old('descricao') }}</textarea>
                        <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                    </div>

                    <!-- Checkbox Notificar Responsável -->
                    <div class="mb-6 flex items-center">
                        <input id="notificar_responsavel" name="notificar_responsavel" type="checkbox" value="1" class="rounded border-gray-300 text-[#329835] shadow-sm focus:ring-[#329835]" {{ old('notificar_responsavel', '1') ? 'checked' : '' }}>
                        <label for="notificar_responsavel" class="ml-2 text-sm text-gray-600 font-medium">
                            Disparar e-mail de notificação ao responsável automaticamente
                        </label>
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end">
                        <a href="{{ route('ocorrencias.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                            {{ __('Registrar Ocorrência') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts: Filtro por Turma + Mudança Dinâmica de Gravidade -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Lógica do Filtro por Turma
            const selectTurma = document.getElementById('turma_filter');
            const selectAluno = document.getElementById('aluno_id');
            const optionsAluno = Array.from(selectAluno.options);

            selectTurma.addEventListener('change', function () {
                const turmaId = this.value;
                selectAluno.value = ""; // Limpa a seleção do aluno ao trocar de turma

                optionsAluno.forEach(option => {
                    if (!option.value) return; // Mantém a opção "Selecione..."

                    const alunoTurmaId = option.getAttribute('data-turma');

                    if (!turmaId || alunoTurmaId === turmaId) {
                        option.style.display = 'block';
                        option.disabled = false;
                    } else {
                        option.style.display = 'none';
                        option.disabled = true;
                    }
                });
            });

            // 2. Lógica da Gravidade Automática
            const selectInfracao = document.getElementById('titulo');
            const selectGravidade = document.getElementById('gravidade');

            function atualizarGravidade() {
                const selectedOption = selectInfracao.options[selectInfracao.selectedIndex];
                const gravidade = selectedOption ? selectedOption.getAttribute('data-gravidade') : null;
                
                if (gravidade) {
                    selectGravidade.value = gravidade;
                }
            }

            selectInfracao.addEventListener('change', atualizarGravidade);

            if (selectInfracao.value) {
                atualizarGravidade();
            }
        });
    </script>
</x-app-layout>