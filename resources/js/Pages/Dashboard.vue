<!-- resources/js/Pages/Dashboard.vue -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
  <AppLayout>
    <div class="pb-3 pb-md-4">
      <h3 class="mb-1">Dashboard</h3>
      <p class="text-muted mb-3">
        Bem-vindo ao DentalTask AI. Aqui depois a gente coloca os cards de agenda, faturamento, etc.
      </p>
    </div>

    <div class="row g-3 g-md-4">
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h6 class="text-muted text-uppercase mb-2 small">Hoje</h6>
            <h4 class="mb-0">0 consultas</h4>
            <p class="text-muted mb-0 small">Em breve: resumo da agenda do dia.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h6 class="text-muted text-uppercase mb-2 small">Pacientes ativos</h6>
            <h4 class="mb-0">—</h4>
            <p class="text-muted mb-0 small">Depois a gente puxa isso do banco.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h6 class="text-muted text-uppercase mb-2 small">Próximos passos</h6>
            <ul class="mb-0 small text-muted">
              <li>Conectar agenda</li>
              <li>Importar pacientes</li>
              <li>Configurar lembretes</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
