<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redireciona para o Google.
     */
    public function redirectToGoogle()
    {
        // Se estiver usando HTTPS certinho e sessão web normal, isso já basta:
        return Socialite::driver('google')->redirect();

        // Se der problema de state (em alguns setups SPA/API), trocar por:
        // return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Callback do Google (login + registro).
     */
    public function handleGoogleCallback()
    {
        try {
            // Se usar stateless() no redirect, tem que usar aqui também
            $googleUser = Socialite::driver('google')->user();

        } catch (\Exception $e) {
            // dd($e->getMessage(), $e->getTraceAsString());
            // Se der erro, volta pro login com uma mensagem genérica
            return redirect()
                ->route('login')
                ->with('status', 'Não foi possível autenticar com o Google. Tente novamente.');
        }
        // dd($googleUser);
        // 1) Tenta achar pelo provider_id (login que já usou Google antes)
        $user = User::where('provider', 'google')
            ->where('provider_id', $googleUser->getId())
            ->first();

        // 2) Se não achar, tenta pelo e-mail (pode ter criado conta antes sem Google)
        if (! $user && $googleUser->getEmail()) {
            $user = User::where('email', $googleUser->getEmail())->first();
        }

        // 3) Se ainda não existir → REGISTRO via Google
        if (! $user) {
            $tenant = Tenant::create([
                'name' => $googleUser->getName()
                    ?: $googleUser->getNickname()
                    ?: $googleUser->getEmail(),
                'email' => $googleUser->getEmail(),
                // outros campos do tenant, se quiser
            ]);
            $user = User::create([
                // se tiver tenant_id obrigatório, aqui a gente ajusta depois
                'tenant_id'   => $tenant->id,
                'name'        => $googleUser->getName()
                    ?: $googleUser->getNickname()
                    ?: $googleUser->getEmail(),
                'email'       => $googleUser->getEmail(),
                // senha aleatória só pra cumprir contrato da tabela
                'password'    => Hash::make(Str::random(40)),
                'provider'    => 'google',
                'provider_id' => $googleUser->getId(),

                // se a sua tabela tiver company_name, phone etc e puderem ser nulos:
                // 'company_name' => null,
                // 'phone'        => null,
            ]);

            event(new Registered($user));

            // Aqui é um bom ponto pra no futuro:
            // - Criar o tenant default
            // - Marcar flag tipo "precisa completar cadastro" e mandar pra tela de onboarding
        } else {
            // 4) Se já existe, só garante que provider e provider_id estão atualizados
            $user->update([
                'provider'    => 'google',
                'provider_id' => $googleUser->getId(),
            ]);
        }

        // 5) Faz login e lembra o usuário
        Auth::login($user, true);

        // 6) Redireciona pra onde você quiser (ex.: dashboard do tenant)
        return redirect()->intended(route('dashboard'));
    }

    /* Se quiser implementar depois o Facebook, fica parecido:

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        // mesma lógica de cima, mudando provider para 'facebook'
    }

    */
}
