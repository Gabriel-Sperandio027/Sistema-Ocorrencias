<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Usuário') }}
            </h2>
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center border-b pb-4 mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Informações da Conta</h3>
                    
                    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-[#329835] hover:bg-[#236B25] text-white text-xs font-semibold rounded-md uppercase tracking-widest transition duration-150 ease-in-out">
                        Editar Usuário
                    </a>
                </div>

                <!-- Grid de Informações -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Nome Completo</span>
                        <p class="text-base font-bold text-gray-800 mt-1">{{ $user->name }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">E-mail</span>
                        <p class="text-base font-semibold text-gray-800 mt-1">{{ $user->email }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Perfil de Acesso</span>
                        <div class="mt-1">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-[#236B25]' }}">
                                {{ $user->role === 'admin' ? 'ADMINISTRADOR' : 'USUÁRIO COMUM (SERVIDOR)' }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Data de Cadastro</span>
                        <p class="text-base font-semibold text-gray-800 mt-1">{{ $user->created_at->format('d/m/Y às H:i') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>