<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Aluno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('alunos.store') }}" method="POST">
                    @csrf

                    <!-- Nome -->
                    <div class="mb-4">
                        <x-input-label for="nome" :value="__('Nome Completo do Aluno')" />
                        <x-text-input id="nome" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="nome" :value="old('nome')" required autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                    </div>

                    <!-- Matrícula -->
                    <div class="mb-4">
                        <x-input-label for="matricula" :value="__('Matrícula')" />
                        <x-text-input id="matricula" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="matricula" :value="old('matricula')" required />
                        <x-input-error :messages="$errors->get('matricula')" class="mt-2" />
                    </div>

                    <!-- Turma -->
                    <div class="mb-4">
                        <x-input-label for="turma_id" :value="__('Turma')" />
                        <select id="turma_id" name="turma_id" class="block mt-1 w-full border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm" required>
                            <option value="">Selecione uma turma...</option>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                                    {{ $turma->nome }} - {{ $turma->curso }} ({{ $turma->ano_letivo }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('turma_id')" class="mt-2" />
                    </div>

                    <!-- E-mail do Aluno -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('E-mail do Aluno (Opcional)')" />
                        <x-text-input id="email" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="email" name="email" :value="old('email')" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- E-mail do Responsável -->
                    <div class="mb-4">
                        <x-input-label for="email_responsavel" :value="__('E-mail do Responsável')" />
                        <x-text-input id="email_responsavel" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="email" name="email_responsavel" :value="old('email_responsavel')" required />
                        <x-input-error :messages="$errors->get('email_responsavel')" class="mt-2" />
                    </div>

                    <!-- Telefone do Responsável -->
                    <div class="mb-4">
                        <x-input-label for="telefone_responsavel" :value="__('Telefone do Responsável (Opcional)')" />
                        <x-text-input id="telefone_responsavel" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="telefone_responsavel" :value="old('telefone_responsavel')" placeholder="(00) 00000-0000" maxlength="15" />
                        <x-input-error :messages="$errors->get('telefone_responsavel')" class="mt-2" />
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="mb-4">
                        <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
                        <x-text-input id="data_nascimento" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="data_nascimento" :value="old('data_nascimento')" placeholder="DD/MM/AAAA" maxlength="10" />
                        <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('alunos.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                            {{ __('Cadastrar Aluno') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script de Máscara de Entrada -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputTelefone = document.getElementById('telefone_responsavel');
            const inputData = document.getElementById('data_nascimento');

            // Máscara para Telefone: (00) 00000-0000 ou (00) 0000-0000
            if (inputTelefone) {
                inputTelefone.addEventListener('input', function (e) {
                    let v = e.target.value.replace(/\D/g, '');
                    v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
                    v = v.replace(/(\d)(\d{4})$/, '$1-$2');
                    e.target.value = v;
                });
            }

            // Máscara para Data: DD/MM/AAAA
            if (inputData) {
                inputData.addEventListener('input', function (e) {
                    let v = e.target.value.replace(/\D/g, '');
                    v = v.replace(/^(\d{2})(\d)/, '$1/$2');
                    v = v.replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3');
                    e.target.value = v;
                });
            }
        });
    </script>
</x-app-layout>