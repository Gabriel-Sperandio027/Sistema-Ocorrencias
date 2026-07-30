<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <!-- Nome -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nome Completo')" />
                        <x-text-input id="name" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- E-mail -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('E-mail')" />
                        <x-text-input id="email" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Perfil / Role -->
                    <div class="mb-4">
                        <x-input-label for="role" :value="__('Perfil de Acesso')" />
                        <select id="role" name="role" class="border-gray-300 focus:border-[#329835] focus:ring-[#329835] rounded-md shadow-sm block mt-1 w-full" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário Comum (Servidor / Professor)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Senha -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirmação de Senha -->
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" type="password" name="password_confirmation" required />
                    </div>

                    <!-- Ações -->
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                            {{ __('Cadastrar Usuário') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>