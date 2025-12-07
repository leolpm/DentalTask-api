<!-- resources/js/Components/Layout/Topbar.vue -->
<template>
  <header class="topbar navbar navbar-expand border-bottom px-3 px-md-4">
    <div class="container-fluid px-0 d-flex align-items-center gap-2 gap-md-3 justify-content-between">
      <div class="d-flex align-items-center gap-2 gap-md-3">
        <button
          class="btn soft-btn btn-icon"
          type="button"
          @click="$emit('toggle-sidebar')"
          aria-label="Alternar menu lateral"
        >
          <i class="bi bi-list"></i>
        </button>
        <div class="brand d-flex align-items-center gap-2">
          <img :src="logoSrc" alt="DentalTask AI" class="brand-logo" />
          <div class="brand-text d-none d-sm-flex flex-column lh-1">
            <span class="fw-bold text-dark">DentalTask AI</span>
            <small class="text-muted">Dashboard</small>
          </div>
        </div>
      </div>

      <div class="topbar-middle flex-grow-1 d-flex align-items-center justify-content-between gap-2 gap-md-3">
        <div class="search-wrapper d-none d-md-flex">
          <div class="search-box navbar-top-search-box">
            <form class="position-relative">
              <input
                class="form-control search-input rounded-pill form-control-sm"
                type="search"
                placeholder="Buscar..."
                aria-label="Buscar"
              />
              <span class="bi bi-search search-box-icon"></span>
            </form>
          </div>
        </div>

        <div class="topbar-buttons d-flex align-items-center gap-2 gap-md-3">
          <button class="btn icon-ghost btn-icon d-md-none" type="button" aria-label="Buscar">
            <i class="bi bi-search"></i>
          </button>

          <a class="icon-nav-item d-flex align-items-center justify-content-center" data-theme-control="theme">
            <span class="theme-icon-active"></span>
          </a>

          <button
            class="btn theme-toggle btn-icon"
            type="button"
            :class="{ 'theme-toggle-dark': theme === 'dark' }"
            @click="$emit('toggle-theme')"
            aria-label="Alternar tema"
          >
            <i :class="theme === 'dark' ? 'bi bi-moon-fill' : 'bi bi-sun-fill'"></i>
          </button>

          <button class="btn bell-btn btn-icon" type="button" aria-label="Notificacoes">
            <i class="bi bi-bell"></i>
          </button>

          <div class="dropdown">
            <button
              class="btn btn-outline-light d-flex align-items-center px-2 px-md-3 py-1 border-0"
              type="button"
              data-bs-toggle="dropdown"
              data-bs-offset="0,10"
              data-bs-boundary="viewport"
              data-bs-display="static"
            >
              <div
                class="avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
              >
                LM
              </div>
              <i class="bi bi-chevron-down ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end user-dropdown">
              <li class="px-3 py-3">
                <div class="d-flex align-items-center gap-2 mb-2">
                  <div class="avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">
                    LM
                  </div>
                  <div class="d-flex flex-column">
                    <span class="fw-semibold">{{ userName }}</span>
                    <small class="text-muted">{{ companyName }}</small>
                  </div>
                </div>
                <div class="text-muted small">
                  <div>Tenant ID: {{ tenantId }}</div>
                  <div>Tipo: {{ userRole }}</div>
                </div>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item" :href="route('profile.edit')">
                  <i class="bi bi-person-circle me-2"></i>Minha conta
                </a>
              </li>
              <li>
                <Link method="post" :href="route('logout')" as="button" class="dropdown-item">
                  <i class="bi bi-box-arrow-right me-2"></i>Sair
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  theme: {
    type: String,
    default: 'light',
  },
})

const logoSrc = '/assets/img/favicons/apple-touch-icon.png'
const userName = 'Leonardo Paixao Moreira'
const companyName = 'Consultorio Saude Bucal'
const tenantId = '31865'
const userRole = 'Dentista administrador(a)'

const isDark = computed(() => props.theme === 'dark')

defineEmits(['toggle-sidebar', 'toggle-theme'])
</script>

<style scoped>
.topbar {
  position: sticky;
  top: 0;
  z-index: 1030;
  min-height: 72px;
  box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
  background: #fff;
}

.btn-icon {
  width: 40px;
  height: 40px;
  border-radius: 12px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0;
}

.soft-btn {
  border: 1px solid #d6d9e0;
  background-color: #fff;
  color: #1f2937;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
}

.soft-btn:hover {
  background-color: #e5edf9;
  border-color: #cfd4dc;
  color: #0f172a;
}

.theme-toggle {
  border: none;
  background: #fff7ed;
  color: #f59e0b;
  box-shadow: none;
  border-radius: 50%;
}

.theme-toggle-dark {
  background: #111827;
  color: #93c5fd;
}

.theme-toggle:hover {
  background: #ffedd5;
  color: #d97706;
}

.theme-toggle.theme-toggle-dark:hover {
  background: #0f172a;
  color: #bfdbfe;
}

.bell-btn {
  border: none;
  background: transparent;
  color: #6b7280;
  box-shadow: none;
}

.bell-btn:hover {
  background: #e5edf9;
  color: #0f172a;
}

.icon-ghost {
  border: none;
  background: transparent;
  color: #4b5563;
  box-shadow: none;
}

.icon-ghost:hover {
  background: #e5edf9;
  color: #0f172a;
}

.brand-logo {
  width: 32px;
  height: 32px;
  object-fit: contain;
  border-radius: 8px;
}

.topbar-middle {
  min-width: 0;
}

.search-wrapper {
  flex: 1 1 auto;
  max-width: 520px;
  display: flex;
  justify-content: center;
  margin: 0 auto;
}

.search-box {
  width: 100%;
  max-width: 520px;
}

.search-box .form-control {
  background: #fff;
  border-radius: 999px;
  border: 1px solid #d6d9e0;
  box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
  padding-left: 2.4rem;
  height: 44px;
}

.search-box .form-control:focus {
  box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
}

.search-box-icon {
  position: absolute;
  left: 1rem;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  pointer-events: none;
}

.notification-badge {
  position: absolute;
  top: 4px;
  right: 4px;
  font-size: 0.65rem;
}

.avatar {
  width: 32px;
  height: 32px;
}

.topbar-buttons {
  flex: 0 0 auto;
}

.user-dropdown {
  min-width: 280px;
  padding: 0;
  box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
  max-width: min(340px, calc(100vw - 16px));
  max-height: calc(100vh - 96px);
  overflow-y: auto;
  right: 0 !important;
  left: auto !important;
  transform: translate3d(0, 0, 0) !important;
  margin-top: 8px;
}

:global(html[data-bs-theme='dark']) .topbar {
  background: #0f172a;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
}

:global(html[data-bs-theme='dark']) .search-box .form-control {
  background: #111827;
  border: 1px solid #1f2937;
  color: #e5e7eb;
}

:global(html[data-bs-theme='dark']) .search-box .form-control::placeholder {
  color: #94a3b8;
}

:global(html[data-bs-theme='dark']) .search-box-icon {
  color: #9ca3af;
}

:global(html[data-bs-theme='dark']) .soft-btn {
  background: #111827;
  border-color: #1f2937;
  color: #e5e7eb;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}

:global(html[data-bs-theme='dark']) .soft-btn:hover {
  background: #1f2937;
  border-color: #2c3548;
}

:global(html[data-bs-theme='dark']) .icon-ghost,
:global(html[data-bs-theme='dark']) .bell-btn {
  color: #cbd5e1;
}

:global(html[data-bs-theme='dark']) .icon-ghost:hover,
:global(html[data-bs-theme='dark']) .bell-btn:hover {
  background: #1f2937;
  color: #e5e7eb;
}

:global(html[data-bs-theme='dark']) .theme-toggle {
  background: #111827;
  color: #93c5fd;
}

:global(html[data-bs-theme='dark']) .theme-toggle.theme-toggle-dark {
  background: #111827;
  color: #93c5fd;
}

:global(html[data-bs-theme='dark']) .theme-toggle.theme-toggle-dark:hover {
  background: #0f172a;
}
</style>
