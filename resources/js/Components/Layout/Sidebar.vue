<!-- resources/js/Components/Layout/Sidebar.vue -->
<template>
  <aside
    class="sidebar shadow-sm"
    :class="{
      'is-open': open,
      'is-collapsed': !open && !isMobile,
      'is-mobile': isMobile,
    }"
  >
    <div class="sidebar-inner d-flex flex-column h-100">
      <div class="flex-grow-1 overflow-auto py-3">
        <ul class="nav flex-column gap-1 px-2">
          <li v-for="item in menuItems" :key="item.label" class="nav-item">
            <Link
              v-if="item.route && hasRoute(item.route)"
              :href="route(item.route)"
              class="nav-link d-flex align-items-center"
              :class="{ active: isCurrent(item.route) }"
              :title="!open && !isMobile ? item.label : null"
              aria-current="page"
            >
              <i :class="['bi', item.icon]"></i>
              <span class="label-text flex-grow-1">{{ item.label }}</span>
            </Link>
            <div
              v-else
              class="nav-link disabled-link d-flex align-items-center"
              :title="!open && !isMobile ? item.label : null"
            >
              <i :class="['bi', item.icon]"></i>
              <span class="label-text">{{ item.label }}</span>
            </div>
          </li>
        </ul>
      </div>

      <div class="border-top px-3 py-3 small text-muted">
        <i class="bi bi-info-circle me-2"></i>
        Versao 1.0.0
      </div>
    </div>
  </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  open: {
    type: Boolean,
    default: true,
  },
  isMobile: {
    type: Boolean,
    default: false,
  },
})

const menuItems = [
  { label: 'Agenda', icon: 'bi-calendar-event', route: 'schedule.index' },
  { label: 'Pacientes', icon: 'bi-people', route: 'patients.index' },
  { label: 'Financeiro', icon: 'bi-cash-coin', route: 'financial.index' },
  { label: 'Relatorios', icon: 'bi-bar-chart', route: 'reports.index' },
  { label: 'Configuracoes', icon: 'bi-gear', route: 'settings.index' },
]

const hasRoute = (name) => {
  try {
    return route().has(name)
  } catch (e) {
    return false
  }
}

const isCurrent = (name) => {
  try {
    return route().current(name)
  } catch (e) {
    return false
  }
}
</script>

<style scoped>
.sidebar {
  --sidebar-width: 260px;
  --sidebar-collapsed-width: 80px;
  width: var(--sidebar-width);
  min-height: 100vh;
  flex-shrink: 0;
  transition: width 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
  z-index: 1045;
  border-right: 1px solid #e5e7eb;
  box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
  background: #fff;
}

.sidebar.is-collapsed {
  width: var(--sidebar-collapsed-width);
}

.sidebar.is-mobile {
  position: fixed;
  top: 72px;
  left: 0;
  height: calc(100vh - 72px);
  transform: translateX(-100%);
}

.sidebar.is-mobile.is-open {
  transform: translateX(0);
}

.sidebar-inner {
  height: 100%;
}

.nav-link {
  border-radius: 0.85rem;
  color: #4b5563;
  font-weight: 600;
  padding: 0.65rem 0.9rem;
  gap: 0.85rem;
  transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
}

.nav-link i {
  font-size: 1rem;
}

.nav-link:hover {
  background-color: #f1f5f9;
  color: #0f172a;
}

.nav-link.active {
  background: linear-gradient(135deg, #0d6efd, #4b8dff);
  color: #fff !important;
  box-shadow: 0 0.75rem 1.5rem rgba(13, 110, 253, 0.18);
}

.disabled-link {
  opacity: 0.55;
  cursor: not-allowed;
}

.label-text {
  white-space: nowrap;
  transition: opacity 0.2s ease, width 0.2s ease, margin 0.2s ease;
}

.sidebar.is-collapsed .label-text,
.sidebar.is-collapsed .brand-text {
  opacity: 0;
  width: 0;
  overflow: hidden;
  margin: 0;
}

.sidebar.is-collapsed .brand-logo {
  margin: 0 auto;
}

.sidebar.is-collapsed .nav-link {
  justify-content: center;
}

.sidebar.is-collapsed .nav-link i {
  margin-right: 0 !important;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: var(--sidebar-width);
    box-shadow: 0 1rem 3rem rgba(15, 23, 42, 0.16);
  }
}

:global(html[data-bs-theme='dark']) .sidebar .nav-link {
  color: #cbd5e1;
}

:global(html[data-bs-theme='dark']) .sidebar .nav-link:hover {
  background-color: #1f2937;
  color: #fff;
}

:global(html[data-bs-theme='dark']) .sidebar .nav-link.active {
  background: linear-gradient(135deg, #2563eb, #4b8dff);
  color: #fff !important;
  box-shadow: 0 0.75rem 1.5rem rgba(37, 99, 235, 0.25);
}
</style>
