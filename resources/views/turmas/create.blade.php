<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Nova Turma') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('turmas.store') }}" method="POST">
                    @csrf

                    <!-- Nome da Turma -->
                    <div class="mb-4">
                        <x-input-label for="nome" :value="__('Nome da Turma (Ex: 1º Ano A)')" />
                        <x-text-input id="nome" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="nome" :value="old('nome')" required autofocus />
                        <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                    </div>

                    <!-- Curso -->
                    <div class="mb-4">
                        <x-input-label for="curso" :value="__('Curso (Ex: Técnico em Informática)')" />
                        <x-text-input id="curso" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="curso" :value="old('curso')" required />
                        <x-input-error :messages="$errors->get('curso')" class="mt-2" />
                    </div>

                    <!-- Ano Letivo -->
                    <div class="mb-4">
                        <x-input-label for="ano_letivo" :value="__('Ano Letivo (Ex: 2026)')" />
                        <x-text-input id="ano_letivo" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="ano_letivo" :value="old('ano_letivo', date('Y'))" required />
                        <x-input-error :messages="$errors->get('ano_letivo')" class="mt-2" />
                    </div>

                    <!-- Ações -->
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('turmas.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                            {{ __('Cadastrar Turma') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>