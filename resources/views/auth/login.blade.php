@extends('layouts.auth')

@section('title', 'Entrar - DentalFlow AI')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="mb-1">Bem-vindo ao DentalFlow AI</h3>
                            <p class="text-body-secondary mb-0">Acesse sua conta ou crie um novo consultório.</p>
                        </div>

                        {{-- Login com Google --}}
                        <a href="{{ route('auth.google.redirect') }}" class="btn btn-outline-secondary w-100 mb-3">
                            <span class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/img/icons/google-icon.svg') }}"
                                     alt="" class="me-2" width="18">
                                <span>Entrar com Google</span>
                            </span>
                        </a>

                        <div class="position-relative my-3">
                            <hr class="text-body-tertiary">
                            <span class="bg-body text-body-tertiary px-2 position-absolute top-50 start-50 translate-middle">
                                ou
                            </span>
                        </div>

                        {{-- Login clássico --}}
                        <form method="post" action="{{ route('login') }}" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Manter conectado
                                    </label>
                                </div>
                                <a href="#" class="fs-9">Esqueci minha senha</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                Entrar
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('login.code') }}" class="fs-9">
                                Entrar recebendo um código por e-mail/telefone
                            </a>
                        </div>

                        <hr>

                        <p class="text-center mb-0 fs-9">
                            Não tem conta?
                            <a href="{{ route('register') }}">Criar meu consultório</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
