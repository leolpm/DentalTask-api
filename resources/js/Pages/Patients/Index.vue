<!-- resources/js/Pages/Patients/Index.vue -->
<template>
  <AppLayout>
    <!-- Cabeçalho da página -->
    <div class="pb-3 pb-md-4">
      <div
        class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"
      >
        <div>
          <h3 class="mb-1">Pacientes</h3>
          <p class="text-muted mb-0">
            Gerencie seus pacientes, prontuários e dados de contato.
          </p>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-secondary">
            <i class="bi bi-download me-1"></i>
            Exportar
          </button>
          <button class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Novo paciente
          </button>
        </div>
      </div>
    </div>

    <!-- Card principal -->
    <div class="card shadow-sm">
      <div class="card-body">
        <!-- Busca -->
        <div
          class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3 gap-2"
        >
          <div class="flex-grow-1">
            <div class="input-group input-group-sm">
              <span class="input-group-text bg-light border-end-0">
                <i class="bi bi-search"></i>
              </span>
              <input
                v-model="search"
                type="text"
                class="form-control border-start-0"
                placeholder="Digite o nome do paciente, CPF, celular do paciente..."
              />
            </div>
          </div>
          <div class="text-muted small">
            {{ filteredPatients.length }} paciente(s) encontrado(s)
          </div>
        </div>

        <!-- Tabela -->
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col" class="text-center">Prontuário</th>
                <th scope="col" class="text-center">Idade</th>
                <th scope="col" class="text-center">CPF</th>
                <th scope="col" class="text-center">Celular do paciente</th>
                <th scope="col" class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="patient in filteredPatients" :key="patient.id">
                <td>
                  <div class="d-flex align-items-center">
                    <div
                      class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                      style="width: 32px; height: 32px;"
                    >
                      <i class="bi bi-person text-muted"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <span class="fw-semibold">{{ patient.name }}</span>
                    </div>
                  </div>
                </td>
                <td class="text-center text-muted">{{ patient.record }}</td>
                <td class="text-center">{{ patient.age }} anos</td>
                <td class="text-center">{{ patient.cpf }}</td>
                <td class="text-center">
                  <a :href="`tel:${patient.phone}`" class="text-decoration-none">
                    {{ patient.phoneFormatted }}
                  </a>
                </td>
                <td class="text-end">
                  <div class="btn-group btn-group-sm">
                    <a
                      :href="`https://wa.me/${patient.whatsNumber}`"
                      target="_blank"
                      class="btn btn-outline-success"
                    >
                      <i class="bi bi-whatsapp"></i>
                    </a>
                    <button class="btn btn-outline-secondary">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-outline-secondary">
                      <i class="bi bi-box-arrow-up-right"></i>
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="!filteredPatients.length">
                <td colspan="6" class="text-center text-muted py-4">
                  Nenhum paciente encontrado com esse filtro.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

// Por enquanto, mock; depois você puxa do Laravel
const patients = ref([
  {
    id: 1,
    name: 'Abel Torres de Araújo',
    record: '12345',
    age: 85,
    cpf: '670.506.467-68',
    phone: '+5521974711348',
    phoneFormatted: '+55 21 97471 1348',
    whatsNumber: '5521974711348'
  },
  {
    id: 2,
    name: 'Acila Moraes de Souza',
    record: '12346',
    age: 65,
    cpf: '670.506.467-90',
    phone: '+5521994034232',
    phoneFormatted: '+55 21 99403 4232',
    whatsNumber: '5521994034232'
  }
  // ... depois você completa com os dados reais
])

const search = ref('')

const filteredPatients = computed(() => {
  if (!search.value) return patients.value

  const term = search.value.toLowerCase()
  return patients.value.filter((p) => {
    return (
      p.name.toLowerCase().includes(term) ||
      p.cpf.toLowerCase().includes(term) ||
      p.phoneFormatted.toLowerCase().includes(term)
    )
  })
})
</script>
