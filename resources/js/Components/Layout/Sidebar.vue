<!-- resources/js/Components/Layout/Sidebar.vue -->
<template>
  <nav
    class="navbar navbar-vertical navbar-expand-lg navbar-light bg-white border-end shadow-sm"
    style="width: 260px;"
  >
    <div class="d-flex flex-column h-100">
      <!-- Logo + nome do sistema -->
      <div class="d-flex align-items-center px-3 py-3 border-bottom">
        <a href="/" class="d-flex align-items-center text-decoration-none">
          <img
            src="/assets/img/favicons/apple-touch-icon.png"
            alt="DentalTask AI"
            width="32"
            class="me-2"
          />
          <div class="d-flex flex-column">
            <span class="fw-bold">DentalTask AI</span>
            <small class="text-muted">Consultório de Saúde Bucal</small>
          </div>
        </a>
      </div>

      <!-- Menu -->
      <div class="flex-grow-1 overflow-auto">
        <ul class="navbar-nav pt-3">
          <li class="nav-item">
            <Link
              :href="route('dashboard')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('dashboard') }"
            >
              <i class="bi bi-lightbulb me-2"></i>
              <span>Inteligência</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('patients.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('patients.index') }"
            >
              <i class="bi bi-people me-2"></i>
              <span>Pacientes</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('agenda.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('agenda.index') }"
            >
              <i class="bi bi-calendar3 me-2"></i>
              <span>Agenda</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('sales.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('sales.index') }"
            >
              <i class="bi bi-receipt me-2"></i>
              <span>Vendas</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('finance.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('finance.index') }"
            >
              <i class="bi bi-cash-stack me-2"></i>
              <span>Financeiro</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('lab.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('lab.index') }"
            >
              <i class="bi bi-badge-3d me-2"></i>
              <span>Controle de prótese</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('marketing.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('marketing.index') }"
            >
              <i class="bi bi-megaphone me-2"></i>
              <span>Marketing</span>
            </Link>
          </li>

          <li class="nav-item">
            <Link
              :href="route('settings.index')"
              class="nav-link d-flex align-items-center px-3 py-2"
              :class="{ active: isCurrent('settings.index') }"
            >
              <i class="bi bi-gear me-2"></i>
              <span>Ajustes</span>
            </Link>
          </li>
        </ul>
      </div>

      <!-- Rodapé do menu -->
      <div class="border-top px-3 py-3 small text-muted">
        <i class="bi bi-info-circle me-1"></i>
        Versão 1.0.0
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()

const isCurrent = (name) =>
  computed(() => page.props?.ziggy?.location && route().current(name)).value
</script>

<style scoped>
.nav-link {
  border-radius: 0.5rem;
  color: #6c757d;
  font-weight: 500;
}

.nav-link:hover {
  background-color: #f1f3f9;
  color: #111827;
}

.nav-link.active {
  background: linear-gradient(135deg, #0d6efd, #4b8dff);
  color: #fff !important;
}
</style>
