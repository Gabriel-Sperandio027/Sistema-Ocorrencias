<x-guest-layout>
    <!-- Logo e Título -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('img/logo.png') }}" class="w-28 h-auto mx-auto mb-3" alt="Logo IFES">
        </a>
        <h1 class="text-xl font-bold text-gray-800">Criar Conta</h1>
        <p class="text-xs text-gray-500 mt-1">Preencha os dados abaixo para se cadastrar</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nome Completo -->
        <div>
            <x-input-label for="name" :value="__('Nome Completo')" />
            <x-text-input id="name" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          required 
                          autofocus 
                          autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Endereço de E-mail -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]"
                          type="password"
                          name="password"
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input id="password_confirmation" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]"
                          type="password"
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-[#329835] rounded-md focus:outline-none" href="{{ route('login') }}">
                {{ __('Já possui uma conta?') }}
            </a>

            <button type="submit" class="py-2.5 px-4 bg-[#329835] hover:bg-[#236B25] text-white font-semibold rounded-md shadow focus:outline-none transition duration-150 ease-in-out uppercase text-xs tracking-widest ms-4">
                {{ __('Cadastrar') }}
            </button>
        </div>
    </form>
</x-guest-layout>