<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Exibe a tela de redefinição de senha.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Processa a requisição de uma nova senha.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Busca o usuário no banco de dados pelo e-mail fornecido
        $user = User::where('email', $request->email)->first();

        // 2. Impede que o usuário utilize a mesma senha atual
        if ($user && Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['A nova senha não pode ser igual à sua senha atual.'],
            ]);
        }

        // Aqui tentamos redefinir a senha do usuário. Se for bem-sucedido,
        // atualizamos a senha no modelo do usuário e salvamos no banco de dados.
        // Caso contrário, tratamos o erro e retornamos a resposta apropriada.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Se a senha foi redefinida com sucesso, redirecionamos o usuário de volta para
        // a tela de login. Se houver algum erro, redirecionamos de volta para onde veio
        // junto com as mensagens de erro.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}