<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'

const form = useForm({ email: '' })

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <Head title="Esqueci a senha" />

  <AuthLayout>
    <AuthHeader
      title="Esqueceu sua senha?"
      subtitle="Informe seu e-mail e enviaremos um link para você criar uma nova senha."
    />

    <!-- se você quiser exibir o status de sucesso -->
    <div v-if="$page.props.flash?.status" class="alert alert-success fs-9">
      {{ $page.props.flash.status }}
    </div>

    <form @submit.prevent="submit">
      <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input v-model="form.email" type="email" class="form-control"
                    :class="{ 'is-invalid': form.errors.email }" required />
                <div v-if="form.errors.email" class="invalid-feedback d-block">
                    {{ form.errors.email }}
                </div>
            </div>

      <button type="submit" class="btn btn-primary w-100" :disabled="form.processing">
        <span v-if="!form.processing">Enviar link de redefinição</span>
        <span v-else><i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>Enviando...</span>
      </button>

      <p class="text-center mt-3 fs-9">
        Voltar para o <Link :href="route('login')">login</Link>
      </p>
    </form>
  </AuthLayout>
</template>
