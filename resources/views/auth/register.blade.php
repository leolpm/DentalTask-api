@extends('layouts.auth')

@section('title', 'Criar conta - DentalFlow AI')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="mb-1">Criar conta</h3>
                            <p class="text-body-secondary mb-0">
                                Comece configurando seu usuário. Depois vamos criar o consultório (tenant).
                            </p>
                        </div>

                        <a href="{{ route('auth.google.redirect') }}" class="btn btn-outline-secondary w-100 mb-3">
                            <span class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/img/icons/google-icon.svg') }}"
                                     alt="" class="me-2" width="18">
                                <span>Criar conta com Google</span>
                            </span>
                        </a>

                        <div class="position-relative my-3">
                            <hr class="text-body-tertiary">
                            <span class="bg-body text-body-tertiary px-2 position-absolute top-50 start-50 translate-middle">
                                ou com e-mail
                            </span>
                        </div>

                        <form method="post" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nome completo</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmar senha</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Continuar para criar consultório
                            </button>
                        </form>

                        <hr>
                        <p class="text-center mb-0 fs-9">
                            Já tem conta? <a href="{{ route('login') }}">Entrar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
