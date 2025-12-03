<!-- resources/js/Layouts/AppLayout.vue -->
<template>
  <div class="d-flex min-vh-100 bg-body-tertiary">
    <!-- Sidebar -->
    <Sidebar />

    <!-- Área principal -->
    <div class="flex-grow-1 d-flex flex-column">
      <!-- Topbar -->
      <Topbar />

      <!-- Conteúdo da página -->
      <main class="flex-grow-1 px-3 px-md-4 py-3">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from '@/Components/Layout/Sidebar.vue'
import Topbar from '@/Components/Layout/Topbar.vue'
</script>

<style scoped>
/* Deixa o fundo mais “app SaaS” */
:global(body) {
  background-color: #f5f7fb;
}
</style>
