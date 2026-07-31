<x-guest-layout>
    <!-- Logo e Título -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('img/logo.png') }}" class="w-30 h-auto mx-auto mb-3" alt="Logo IFES">
        </a>
        <h1 class="text-2xl font-bold text-black">Confirmação de Segurança</h1>
        <p class="text-sm text-black mt-1">Confirme sua senha para continuar</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de prosseguir.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Senha -->
        <div>
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]"
                          type="password"
                          name="password"
                          required 
                          autocomplete="current-password" 
                          autofocus />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="w-full py-2.5 px-4 bg-[#329835] hover:bg-[#236B25] text-white font-semibold rounded-md shadow focus:outline-none transition duration-150 ease-in-out uppercase text-xs tracking-widest text-center">
                {{ __('Confirmar Senha') }}
            </button>
        </div>
    </form>
</x-guest-layout>