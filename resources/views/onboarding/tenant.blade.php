@extends('layouts.auth')

@section('title', 'Configurar consultório - DentalFlow AI')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-1">Dados do consultório</h3>
                        <p class="text-body-secondary mb-4">
                            Essas informações serão usadas nos relatórios, mensagens ao paciente
                            e configuração do seu ambiente.
                        </p>

                        <form method="post" action="{{ route('onboarding.tenant.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nome da clínica / consultório</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome fantasia</label>
                                    <input type="text" name="trade_name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CPF ou CNPJ</label>
                                    <input type="text" name="document" class="form-control">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Telefone fixo</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">WhatsApp principal</label>
                                    <input type="text" name="whatsapp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">E-mail de contato</label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ auth()->user()->email }}">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="address" class="form-control">
                            </div>

                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" name="city" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Estado</label>
                                    <input type="text" name="state" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">CEP</label>
                                    <input type="text" name="zip_code" class="form-control">
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Concluir e entrar no sistema
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
