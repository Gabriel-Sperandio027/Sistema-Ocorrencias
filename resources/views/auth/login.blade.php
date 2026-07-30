<x-guest-layout>
    <!-- Logo e Títulos -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('img/logo-ifes.png') }}" class="w-30 h-auto mx-auto mb-3" alt="Logo IFES">
        </a>
        
        <h1 class="text-2xl font-bold text-black">Sistema de Ocorrências</h1>
        <p class="text-sm text-black mt-1">Insira suas credenciais para acessar o painel</p>
    </div>

    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- E-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          autocomplete="username" 
                          placeholder="seu.email@exemplo.com" />
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
                          autocomplete="current-password" 
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Lembrar-me & Esqueceu a senha -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#329835] shadow-sm focus:ring-[#329835]" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-[#329835] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#329835]" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a senha?') }}
                </a>
            @endif
        </div>

        <!-- Botão Entrar -->
        <div class="mt-6">
            <button type="submit" class="w-full py-2.5 px-4 bg-[#329835] hover:bg-[#236B25] text-white font-semibold rounded-md shadow focus:outline-none transition duration-150 ease-in-out uppercase text-xs tracking-widest">
                {{ __('Entrar no Sistema') }}
            </button>
        </div>
    </form>
</x-guest-layout>