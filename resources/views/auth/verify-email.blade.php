<x-guest-layout>
    <!-- Logo e Título -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-block">
            <img src="{{ asset('img/logo-ifes.png') }}" class="w-28 h-auto mx-auto mb-3" alt="Logo IFES">
        </a>
        <h1 class="text-2xl font-bold text-black">Verifique seu E-mail</h1>
        <p class="text-sm text-black mt-1">Confirmação de cadastro requerida</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Obrigado por se cadastrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se não recebeu o e-mail, teremos o prazer de enviar outro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-700 bg-green-100 p-3 rounded-md border border-green-300">
            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o cadastro.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="py-2.5 px-4 bg-[#329835] hover:bg-[#236B25] text-white font-semibold rounded-md shadow focus:outline-none transition duration-150 ease-in-out uppercase text-xs tracking-widest">
                    {{ __('Reenviar E-mail') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-[#329835] rounded-md focus:outline-none">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</x-guest-layout>