<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompleteRegistrationController extends Controller
{
    public function edit(Request $request, Tenant $tenant)
    {
        // aqui você pode validar se o usuário logado é dono desse tenant, etc.

        $user = $request->user();

        // dd($tenant);
        if (! $user) {
            return redirect()->route('login');
        }

        return Inertia::render('Auth/CompleteRegistration', [
            'tenantId'     => $tenant->id,
            'company_name' => $tenant->name ?? '',
            'email'        => $user->email,
            'phone'        => $user->phone ?? '',
        ]);
    }

    public function update(Request $request, Tenant $tenant)
    {
        $data = $request->validate([
            'tenant_id'    => ['required', 'integer'],
            'company_name' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'document'     => ['required', 'string', 'max:20'],
            'cep'          => ['required', 'string', 'max:9'],
            'address'      => ['required', 'string', 'max:255'],
            'number'       => ['required', 'string', 'max:50'],
            'complement'   => ['nullable', 'string', 'max:255'],
            'district'     => ['required', 'string', 'max:255'],
            'city'         => ['required', 'string', 'max:255'],
            'state'        => ['required', 'string', 'max:2'],
        ]);

        // Atualiza o tenant (ajuste nomes de colunas conforme sua migration)
        $tenant->update([
            'name'        => $data['company_name'],
            'document'    => $data['document'], // CPF/CNPJ (formatado ou só dígitos, você decide)
            'cep'         => $data['cep'],
            'address'     => $data['address'],
            'number'      => $data['number'],
            'complement'  => $data['complement'] ?? null,
            'district'    => $data['district'],
            'city'        => $data['city'],
            'state'       => strtoupper($data['state']),
            'is_completed' => true,
        ]);

        // Pode também atualizar o user com telefone, se fizer sentido:
        $user = $request->user();
        if ($user && empty($user->phone)) {
            $user->phone = $data['phone'] ?? $user->phone;
            $user->save();
        }

        return redirect()
            ->route('dashboard')
            ->with('status', 'Cadastro da clínica finalizado com sucesso!');
    }
}
