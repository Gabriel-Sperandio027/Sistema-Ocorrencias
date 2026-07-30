<x-guest-layout>
    <!-- Logo e Título -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('img/logo-ifes.png') }}" class="w-28 h-auto mx-auto mb-3" alt="Logo IFES">
        </a>
        <h1 class="text-xl font-bold text-gray-800">Recuperar Senha</h1>
        <p class="text-xs text-gray-500 mt-1">Informe seu e-mail para receber o link de redefinição</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e lhe enviaremos um link de redefinição de senha por e-mail.') }}
    </div>

    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Endereço de E-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          placeholder="seu.email@exemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-[#329835] underline">
                Voltar para o login
            </a>

            <button type="submit" class="py-2.5 px-4 bg-[#329835] hover:bg-[#236B25] text-white font-semibold rounded-md shadow focus:outline-none transition duration-150 ease-in-out uppercase text-xs tracking-widest">
                {{ __('Enviar Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>