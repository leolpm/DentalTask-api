<!-- resources/js/Layouts/AppLayout.vue -->
<template>
  <div class="app-shell position-relative">
    <Topbar :theme="theme" @toggle-sidebar="toggleSidebar" @toggle-theme="toggleTheme" />

    <div class="app-body d-flex">
      <Sidebar :open="isSidebarOpen" :is-mobile="isMobile" @close="closeSidebar" />

      <main class="app-main flex-grow-1 px-3 px-md-4 py-3">
        <slot />
      </main>
    </div>

    <transition name="fade">
      <div
        v-if="isMobile && isSidebarOpen"
        class="sidebar-backdrop"
        @click="closeSidebar"
      ></div>
    </transition>
  </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'
import Sidebar from '@/Components/Layout/Sidebar.vue'
import Topbar from '@/Components/Layout/Topbar.vue'

const isSidebarOpen = ref(true)
const isMobile = ref(false)
const theme = ref('light')
const THEME_KEY = 'phoenixTheme'

const updateViewport = () => {
  const mobile = window.innerWidth < 992
  if (mobile !== isMobile.value) {
    isMobile.value = mobile
    isSidebarOpen.value = mobile ? false : true
  }
}

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}

const closeSidebar = () => {
  isSidebarOpen.value = false
}

const applyTheme = (value) => {
  theme.value = value
  const html = document.documentElement
  const resolved =
    value === 'auto'
      ? (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
      : value
  html.setAttribute('data-theme', value)
  html.setAttribute('data-bs-theme', resolved)
  localStorage.setItem(THEME_KEY, value)
}

const toggleTheme = () => {
  applyTheme(theme.value === 'dark' ? 'light' : 'dark')
}

onMounted(() => {
  updateViewport()
  window.addEventListener('resize', updateViewport)
  const saved = localStorage.getItem(THEME_KEY)
  const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
  applyTheme(saved || (prefersDark ? 'dark' : 'light'))
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', updateViewport)
})
</script>

<style scoped>
:global(body) {
  background-color: #eef2f7 !important;
  color: #0f172a;
  font-family: 'Inter', 'Nunito Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
}

:global(html[data-bs-theme='dark'] body) {
  background-color: #0b1021 !important;
  color: #e5e7eb !important;
}

.app-shell {
  min-height: 100vh;
  background-color: #eef2f7;
}

:global(html[data-bs-theme='dark']) .app-shell {
  background-color: #0b1021 !important;
}

.app-body {
  min-height: calc(100vh - 72px);
  display: flex;
}

:global(html[data-bs-theme='dark']) .app-body,
:global(html[data-bs-theme='dark']) .app-main,
:global(html[data-bs-theme='dark']) main,
:global(html[data-bs-theme='dark']) #app {
  background-color: #0b1021 !important;
}

.app-main {
  background-color: transparent;
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
  min-width: 0;
}

:global(html[data-bs-theme='dark']) .app-main {
  color: #e5e7eb;
  background-color: #0b1021 !important;
}

:global(html[data-bs-theme='dark']) .app-main,
:global(html[data-bs-theme='dark']) .app-main > * {
  background-color: transparent !important;
}

:global(html[data-bs-theme='dark']) .topbar {
  background-color: #0f172a;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
}

:global(html[data-bs-theme='dark']) .sidebar {
  background: #111827;
  border-color: #1f2937;
  box-shadow: 0 10px 35px rgba(0, 0, 0, 0.35);
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
  box-shadow: 0 0.75rem 1.5rem rgba(37, 99, 235, 0.25);
}

:global(html[data-bs-theme='dark']) .card,
:global(html[data-bs-theme='dark']) .bg-white {
  background-color: #111827 !important;
  color: #e5e7eb;
  border-color: #1f2937 !important;
}

:global(html[data-bs-theme='dark']) .bg-body,
:global(html[data-bs-theme='dark']) .bg-body-secondary,
:global(html[data-bs-theme='dark']) .bg-body-tertiary {
  background-color: #0b1021 !important;
  color: #e5e7eb !important;
}

:global(html[data-bs-theme='dark']) .panel,
:global(html[data-bs-theme='dark']) .list-group-item,
:global(html[data-bs-theme='dark']) .nav-link,
:global(html[data-bs-theme='dark']) .btn-light {
  color: #e5e7eb;
}

:global(html[data-bs-theme='dark']) .border,
:global(html[data-bs-theme='dark']) .border-bottom,
:global(html[data-bs-theme='dark']) .border-top,
:global(html[data-bs-theme='dark']) .border-start,
:global(html[data-bs-theme='dark']) .border-end {
  border-color: #1f2937 !important;
}

:global(html[data-bs-theme='dark']) .text-muted,
:global(html[data-bs-theme='dark']) .text-body-secondary {
  color: #cbd5e1 !important;
}

:global(html[data-bs-theme='dark']) a {
  color: #93c5fd;
}

:global(html[data-bs-theme='dark']) a:hover {
  color: #bfdbfe;
}

.sidebar-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.35);
  backdrop-filter: blur(1px);
  z-index: 1040;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

:global(html[data-bs-theme='dark']) .bell-btn:hover,
:global(html[data-bs-theme='dark']) .icon-ghost:hover,
:global(html[data-bs-theme='dark']) .soft-btn:hover {
  background: #1f2937;
  color: #e5e7eb;
}
</style>
