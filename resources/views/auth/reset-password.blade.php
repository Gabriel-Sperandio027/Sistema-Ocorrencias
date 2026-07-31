<x-guest-layout>
    <!-- Logo e Título -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('img/logo-ifes.png') }}" class="w-30 h-auto mx-auto mb-3" alt="Logo IFES">
        </a>
        <h1 class="text-2xl font-bold text-black">Redefinir Senha</h1>
        <p class="text-sm text-black mt-1">Crie uma nova senha para acessar o sistema</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token de Redefinição de Senha -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Endereço de E-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="email" 
                          name="email" 
                          :value="old('email', $request->email)" 
                          required 
                          autofocus 
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nova Senha -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Nova Senha')" />
            <x-text-input id="password" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="password" 
                          name="password" 
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Nova Senha -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Nova Senha')" />
            <x-text-input id="password_confirmation" 
                          class="block mt-1 w-full focus:border-[#329835] focus:ring-[#329835]" 
                          type="password" 
                          name="password_confirmation" 
                          required 
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full py-2.5 px-4 bg-[#329835] hover:bg-[#236B25] text-white font-semibold rounded-md shadow focus:outline-none transition duration-150 ease-in-out uppercase text-xs tracking-widest text-center">
                {{ __('Redefinir Senha') }}
            </button>
        </div>
    </form>
</x-guest-layout>