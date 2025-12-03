<!-- resources/js/Components/Layout/Topbar.vue -->
<template>
  <header class="navbar navbar-expand bg-white border-bottom shadow-sm px-3 px-md-4">
    <div class="container-fluid px-0">
      <!-- Esquerda: Breadcrumb / nome da tela -->
      <div class="d-flex align-items-center">
        <button
          class="btn btn-link d-lg-none me-2 p-0 text-secondary"
          type="button"
          @click="$emit('toggle-sidebar')"
        >
          <i class="bi bi-list fs-4"></i>
        </button>
        <h6 class="mb-0 fw-semibold text-muted">
          Simples Dental &gt; <span class="text-body">Pacientes</span>
        </h6>
      </div>

      <!-- Direita: ações / usuário -->
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-outline-secondary btn-sm d-none d-md-inline-flex">
          <i class="bi bi-question-circle me-1"></i>
          Como funciona
        </button>

        <button class="btn btn-link position-relative p-0 text-secondary">
          <i class="bi bi-bell fs-5"></i>
          <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
            style="font-size: 0.65rem;"
          >
            11
          </span>
        </button>

        <!-- Usuário -->
        <div class="dropdown">
          <button
            class="btn btn-outline-light d-flex align-items-center px-2 px-md-3 py-1 border-0"
            type="button"
            data-bs-toggle="dropdown"
          >
            <div
              class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
              style="width: 32px; height: 32px;"
            >
              LM
            </div>
            <div class="d-none d-md-flex flex-column align-items-start">
              <span class="fw-semibold small">Leonardo Paixão Moreira</span>
              <small class="text-muted">Consultório Saúde Bucal</small>
            </div>
            <i class="bi bi-chevron-down ms-2"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <h6 class="dropdown-header mb-0">
                Dentista administrador(a)<br />
                <small class="text-muted">ID: 31865</small>
              </h6>
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
  </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
