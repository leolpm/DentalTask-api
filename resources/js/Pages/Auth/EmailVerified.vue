<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'
</script>

<template>
  <Head title="E-mail confirmado" />

  <AuthLayout>
    <AuthHeader
      title="E-mail confirmado!"
      subtitle="Seu endereço de e-mail foi verificado com sucesso."
    />

    <p class="mb-4">
      Obrigado por confirmar seu e-mail. Agora você já pode usar todas as funcionalidades
      do DentalTask AI.
    </p>

    <div class="d-grid gap-2">
      <Link :href="route('dashboard')" class="btn btn-primary">
        Ir para o painel
      </Link>
    </div>
  </AuthLayout>
</template>
