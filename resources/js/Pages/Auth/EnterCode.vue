<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'

const form = useForm({ email: '' })

const submit = () => {
  form.post(route('login.code.send'))
}
</script>

<template>
  <Head title="Código por e-mail" />

  <AuthLayout>
    <AuthHeader
      title="Entrar com código"
      subtitle="Vamos enviar um código de acesso para o seu e-mail"
    />

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
        <span v-if="!form.processing">Enviar código</span>
        <span v-else><i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>Enviando...</span>
      </button>

      <p class="text-center mt-3 fs-9">
        Voltar para o <Link :href="route('login')">login</Link>
      </p>
    </form>
  </AuthLayout>
</template>
