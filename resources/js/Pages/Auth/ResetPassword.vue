<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'

const props = defineProps({
  email: String,
  token: String,
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

const submit = () => form.post(route('password.store'))
</script>

<template>
  <Head title="Nova senha" />

  <AuthLayout>
    <AuthHeader
      title="Definir nova senha"
      subtitle="Escolha uma nova senha para acessar sua conta"
    />

    <form @submit.prevent="submit">
      <div class="mb-3">
        <label class="form-label">Nova senha</label>
        <input v-model="form.password" type="password" class="form-control" />
      </div>

      <div class="mb-3">
        <label class="form-label">Confirmar senha</label>
        <input v-model="form.password_confirmation" type="password" class="form-control" />
      </div>

      <button type="submit" class="btn btn-primary w-100" :disabled="form.processing">
        <span v-if="!form.processing">Salvar senha</span>
        <span v-else><i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>Salvando...</span>
      </button>
    </form>
  </AuthLayout>
</template>
