<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'

const form = useForm({
  company_name: '',
  name: '',
  phone: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => form.post(route('register'))
</script>

<template>
  <Head title="Criar conta" />

  <AuthLayout>
    <!-- Cabeçalho -->
    <AuthHeader
      title="Criar conta"
      subtitle="Cadastre sua clínica e comece a usar o DentalTask AI"
    />

    <!-- Social logins -->
    <div class="d-grid gap-2 mb-3">
      <a
        :href="route('auth.google.redirect')"
        class="btn btn-subtle-secondary d-flex align-items-center justify-content-center"
      >
        <span class="me-2">
          <i class="fa-brands fa-google text-danger fs-8"></i>
        </span>
        <span>Cadastrar com Google</span>
      </a>
    </div>

    <!-- divisor -->
    <div class="position-relative my-3">
      <hr class="text-body-tertiary" />
      <span
        class="bg-body text-body-tertiary px-2 position-absolute top-50 start-50 translate-middle fs-9"
      >
        ou usar e-mail
      </span>
    </div>

    <!-- Formulário -->
    <form @submit.prevent="submit">
      <!-- Nome da empresa -->
      <div class="mb-3">
        <label class="form-label">Nome da empresa</label>
        <input
          v-model="form.company_name"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': form.errors.company_name }"
        />
        <div v-if="form.errors.company_name" class="invalid-feedback">
          {{ form.errors.company_name }}
        </div>
      </div>

      <!-- Nome -->
      <div class="mb-3">
        <label class="form-label">Seu nome</label>
        <input
          v-model="form.name"
          type="text"
          class="form-control"
          :class="{ 'is-invalid': form.errors.name }"
        />
        <div v-if="form.errors.name" class="invalid-feedback">
          {{ form.errors.name }}
        </div>
      </div>

      <!-- Telefone -->
      <div class="mb-3">
        <label class="form-label">Telefone (WhatsApp)</label>
        <input
          v-model="form.phone"
          type="tel"
          class="form-control"
          :class="{ 'is-invalid': form.errors.phone }"
        />
        <div v-if="form.errors.phone" class="invalid-feedback">
          {{ form.errors.phone }}
        </div>
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input
          v-model="form.email"
          type="email"
          class="form-control"
          :class="{ 'is-invalid': form.errors.email }"
        />
        <div v-if="form.errors.email" class="invalid-feedback">
          {{ form.errors.email }}
        </div>
      </div>

      <!-- Senha -->
      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input
          v-model="form.password"
          type="password"
          class="form-control"
          :class="{ 'is-invalid': form.errors.password }"
          autocomplete="new-password"
        />
        <div v-if="form.errors.password" class="invalid-feedback">
          {{ form.errors.password }}
        </div>
      </div>

      <!-- Confirmar senha -->
      <div class="mb-3">
        <label class="form-label">Confirmar senha</label>
        <input
          v-model="form.password_confirmation"
          type="password"
          class="form-control"
          autocomplete="new-password"
        />
      </div>

      <!-- Botão -->
      <button
        type="submit"
        class="btn btn-primary w-100"
        :disabled="form.processing"
      >
        <span v-if="!form.processing">Criar conta</span>
        <span v-else>
          <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
          Processando...
        </span>
      </button>

      <p class="mt-3 mb-0 text-center fs-9">
        Já possui conta?
        <Link :href="route('login')">Entrar</Link>
      </p>
    </form>
  </AuthLayout>
</template>
