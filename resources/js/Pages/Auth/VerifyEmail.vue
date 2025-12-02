<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'

const props = defineProps({
  status: {
    type: String,
    default: null,
  },
  email: {
    type: String,
    default: '',
  },
})

const form = useForm({})

const resend = () => {
  form.post(route('verification.send'))
}
</script>

<template>
  <Head title="Confirmar e-mail" />

  <AuthLayout>
    <AuthHeader
      title="Confirme seu e-mail"
      :subtitle="`Enviamos um link para ${email}. Verifique sua caixa de entrada.`"
    />

    <div v-if="status === 'verification-link-sent'" class="alert alert-success fs-9">
      Um novo link de verificação foi enviado para o seu e-mail.
    </div>

    <p class="mb-4">
      Para continuar usando o DentalTask AI, você precisa confirmar seu endereço de e-mail.
      Caso não tenha recebido, você pode solicitar um novo link abaixo.
    </p>

    <form @submit.prevent="resend">
      <button
        type="submit"
        class="btn btn-primary w-100 mb-3"
        :disabled="form.processing"
      >
        <span v-if="!form.processing">Reenviar link de verificação</span>
        <span v-else>
          <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
          Enviando...
        </span>
      </button>
    </form>

    <p class="text-center fs-9 mb-0">
      Digitou o e-mail errado?
      <Link :href="route('profile.edit')">
        Atualizar e-mail
      </Link>
      ou
      <Link :href="route('logout')" method="post" as="button" class="btn btn-link p-0 align-baseline">
        sair
      </Link>
      e entrar com outra conta.
    </p>
  </AuthLayout>
</template>
