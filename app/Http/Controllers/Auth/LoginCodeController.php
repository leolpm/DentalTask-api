<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthCode;
use App\Models\User;
use App\Notifications\LoginCodeNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class LoginCodeController extends Controller
{
    // Tela para informar o e-mail e pedir o código
    public function create()
    {
        return Inertia::render('Auth/EnterCode', [
            'step' => 'request',
        ]);
    }

    // Enviar código para o e-mail
    public function send(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Não encontramos nenhum usuário com esse e-mail.',
            ]);
        }

        $plainCode = (string) random_int(100000, 999999);

        AuthCode::updateOrCreate(
            [
                'user_id' => $user->id,
                'channel' => 'email',
            ],
            [
                'code' => Hash::make($plainCode),
                'sent_to' => $user->email,
                'expires_at' => now()->addMinutes(10),
            ]
        );

        // URL da tela de digitar o código
        $url = route('login.code.verify', [
            'email' => $user->email,
            'user_id' => $user->id,
        ]);

        $user->notify(new LoginCodeNotification($plainCode, $url));

        return redirect()->route('login.code.verify', [
            'email' => $user->email,
            'user_id' => $user->id,
        ]);
    }

    // Tela para digitar o código
    public function showVerify(Request $request)
    {
        return Inertia::render('Auth/VerifyCode', [
            'step' => 'verify',
            'email' => $request->get('email'),
            'user_id' => $request->get('user_id'),
        ]);
    }

    // Validar código e logar
    public function verify(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'email' => ['required', 'email'],
            'code' => ['required', 'string'],
        ]);

        $record = AuthCode::where('user_id', $request->user_id)
            ->where('sent_to', $request->email)
            ->first();

        if (! $record) {
            return back()->withErrors([
                'code' => 'Código inválido ou expirado.',
            ]);
        }

        if (Carbon::now()->greaterThan($record->expires_at)) {
            $record->delete();

            return back()->withErrors([
                'code' => 'Código expirado. Solicite um novo.',
            ]);
        }

        if (! Hash::check($request->code, $record->code)) {
            return back()->withErrors([
                'code' => 'Código incorreto.',
            ]);
        }

        // código ok: apaga e loga
        $record->delete();

        $user = User::where('id', $request->user_id)->firstOrFail();
        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }
}
