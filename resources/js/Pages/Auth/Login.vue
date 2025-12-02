<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import { ref } from 'vue'

const socialLoading = ref(false)

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}

const loginWithGoogle = () => {
  socialLoading.value = true
  window.location = route('auth.google.redirect')
}
</script>

<template>
  <Head title="Entrar" />

    <AuthLayout>
        <div class="w-100 d-flex flex-column justify-content-center align-items-center mb-4 text-center">
            <img src="/assets/img/favicons/apple-touch-icon.png" alt="" width="60" class="mb-2" />
            <h3 class="mb-1">Entrar</h3>
            <p class="text-body-secondary mb-0">Acesse sua conta DentalTask AI</p>
        </div>

        <!-- Social logins -->
        <div class="d-grid gap-2 mb-3">
            <button
                type="button"
                class="btn btn-subtle-secondary d-flex align-items-center justify-content-center"
                :disabled="socialLoading"
                @click="loginWithGoogle"
                >
                <span class="me-2">
                    <i
                    class="fa-brands fa-google fs-8"
                    :class="socialLoading ? 'fa-spin' : 'text-danger'"
                    ></i>
                </span>
                <span v-if="!socialLoading">Entrar com Google</span>
                <span v-else>Redirecionando...</span>
            </button>

            <!-- <a
                :href="route('auth.facebook.redirect')"
                class="btn btn-subtle-secondary d-flex align-items-center justify-content-center"
                >
                <span class="me-2">
                <i class="bi bi-facebook"></i>
                </span>
                <span>Entrar com Facebook</span>
            </a> -->
        </div>

        <div class="position-relative my-3">
            <hr class="text-body-tertiary" />
            <span
                class="bg-body text-body-tertiary px-2 position-absolute top-50 start-50 translate-middle">
                ou usar e-mail
            </span>
        </div>

        <form @submit.prevent="submit" novalidate>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input v-model="form.email" type="email" class="form-control"
                    :class="{ 'is-invalid': form.errors.email }" required />
                <div v-if="form.errors.email" class="invalid-feedback d-block">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input v-model="form.password" type="password" class="form-control"
                    :class="{ 'is-invalid': form.errors.password }" required />
                <div v-if="form.errors.password" class="invalid-feedback d-block">
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input id="remember" v-model="form.remember" class="form-check-input"
                        type="checkbox" />
                    <label class="form-check-label" for="remember"> Lembrar de mim </label>
                </div>

                <a :href="route('password.request')" class="fs-9">Esqueci minha senha</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3"
                :disabled="form.processing">
                <span v-if="form.processing"
                    class="spinner-border spinner-border-sm me-2" />
                Entrar
            </button>
        </form>

        <p class="text-center mb-0 fs-9">
            Ainda não tem conta?
            <Link :href="route('register')">Criar uma conta</Link>
        </p>

        <p class="text-center mb-0 mt-2 fs-9">
            Ou
        </p>
        <p class="text-center mb-0 mt-2 fs-9">
            <Link :href="route('login.code.request')" class="fs-9">
                Entrar com código por e-mail
            </Link>
        </p>
  </AuthLayout>
</template>
