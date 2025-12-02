<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
  tenantId: {
    type: Number,
    required: true,
  },
  company_name: {
    type: String,
    default: '',
  },
  email: {
    type: String,
    default: '',
  },
  phone: {
    type: String,
    default: '',
  },
})

const form = useForm({
  tenant_id: props.tenantId,
  company_name: props.company_name || '',
  email: props.email || '',
  phone: props.phone || '',
  document: '',
  cep: '',
  address: '',
  number: '',
  complement: '',
  district: '',
  city: '',
  state: '',
})

const loadingCep = ref(false)
const cepError = ref('')

// helper pra pegar só dígitos
const onlyDigits = (value) => (value || '').replace(/\D/g, '')

// máscara dinâmica CPF/CNPJ
const handleDocumentInput = (event) => {
  let digits = onlyDigits(event.target.value)

  if (digits.length <= 11) {
    // CPF: 000.000.000-00
    digits = digits.slice(0, 11)
    let v = ''
    if (digits.length > 3) v = digits.slice(0, 3) + '.' + digits.slice(3)
    else v = digits
    if (digits.length > 6) v = v.slice(0, 7) + '.' + v.slice(7)
    if (digits.length > 9) v = v.slice(0, 11) + '-' + v.slice(11)
    form.document = v
  } else {
    // CNPJ: 00.000.000/0000-00
    digits = digits.slice(0, 14)
    let v = ''
    if (digits.length > 2) v = digits.slice(0, 2) + '.' + digits.slice(2)
    else v = digits
    if (digits.length > 5) v = v.slice(0, 6) + '.' + v.slice(6)
    if (digits.length > 8) v = v.slice(0, 10) + '/' + v.slice(10)
    if (digits.length > 12) v = v.slice(0, 15) + '-' + v.slice(15)
    form.document = v
  }
}

const docTypeLabel = computed(() => {
  const len = onlyDigits(form.document).length
  if (!len) return 'CPF ou CNPJ'
  return len <= 11 ? 'CPF' : 'CNPJ'
})

// buscar CEP no ViaCEP
const handleCepBlur = async () => {
  const digits = onlyDigits(form.cep)

  cepError.value = ''
  if (digits.length !== 8) {
    if (digits.length > 0) {
      cepError.value = 'CEP deve ter 8 dígitos.'
    }
    return
  }

  try {
    loadingCep.value = true
    const response = await fetch(`https://viacep.com.br/ws/${digits}/json/`)
    const data = await response.json()

    if (data.erro) {
      cepError.value = 'CEP não encontrado.'
      return
    }

    form.address = data.logradouro || ''
    form.district = data.bairro || ''
    form.city = data.localidade || ''
    form.state = data.uf || ''
  } catch (e) {
    cepError.value = 'Erro ao buscar o CEP. Tente novamente.'
  } finally {
    loadingCep.value = false
  }
}

const submit = () => {
  form.post(route('tenants.complete.store', { tenant: props.tenantId }))
}
</script>

<template>
  <Head title="Completar cadastro da clínica" />

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-xl-7">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4 p-md-5">
            <h2 class="mb-1">Completar cadastro da clínica</h2>
            <p class="text-body-secondary mb-4">
              Só mais alguns dados para finalizar o cadastro do seu tenant no DentalTask AI.
            </p>

            <form @submit.prevent="submit" novalidate>
              <!-- Dados básicos -->
              <div class="mb-3">
                <label class="form-label">Nome da empresa / clínica</label>
                <input
                  v-model="form.company_name"
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.company_name }"
                />
                <div v-if="form.errors.company_name" class="invalid-feedback">
                  {{ form.errors.company_name }}
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">E-mail</label>
                  <input
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.email }"
                    readonly
                  />
                  <div v-if="form.errors.email" class="invalid-feedback">
                    {{ form.errors.email }}
                  </div>
                  <div class="form-text">
                    Esse é o e-mail usado no primeiro cadastro.
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label">Telefone / WhatsApp</label>
                  <input
                    v-model="form.phone"
                    type="tel"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.phone }"
                  />
                  <div v-if="form.errors.phone" class="invalid-feedback">
                    {{ form.errors.phone }}
                  </div>
                </div>
              </div>

              <!-- Documento -->
              <div class="mb-3">
                <label class="form-label">
                  {{ docTypeLabel }}
                </label>
                <input
                  :value="form.document"
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.document }"
                  @input="handleDocumentInput"
                />
                <div v-if="form.errors.document" class="invalid-feedback">
                  {{ form.errors.document }}
                </div>
                <div class="form-text">
                  Digite apenas os números; o formato será aplicado automaticamente.
                </div>
              </div>

              <hr class="my-4" />

              <!-- Endereço -->
              <h5 class="mb-3">Endereço da clínica</h5>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">CEP</label>
                  <div class="input-group">
                    <input
                      v-model="form.cep"
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.cep || cepError }"
                      @blur="handleCepBlur"
                    />
                    <span class="input-group-text">
                      <i
                        v-if="loadingCep"
                        class="fa-solid fa-arrows-rotate fa-spin"
                      ></i>
                      <i
                        v-else
                        class="fa-solid fa-magnifying-glass-location"
                      ></i>
                    </span>
                    <div
                      v-if="form.errors.cep || cepError"
                      class="invalid-feedback d-block"
                    >
                      {{ form.errors.cep || cepError }}
                    </div>
                  </div>
                  <div class="form-text">
                    Após digitar o CEP, vamos buscar automaticamente o endereço.
                  </div>
                </div>

                <div class="col-md-8 mb-3">
                  <label class="form-label">Endereço</label>
                  <input
                    v-model="form.address"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.address }"
                  />
                  <div v-if="form.errors.address" class="invalid-feedback">
                    {{ form.errors.address }}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">Número</label>
                  <input
                    v-model="form.number"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.number }"
                  />
                  <div v-if="form.errors.number" class="invalid-feedback">
                    {{ form.errors.number }}
                  </div>
                </div>

                <div class="col-md-8 mb-3">
                  <label class="form-label">Complemento</label>
                  <input
                    v-model="form.complement"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.complement }"
                  />
                  <div v-if="form.errors.complement" class="invalid-feedback">
                    {{ form.errors.complement }}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Bairro</label>
                  <input
                    v-model="form.district"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.district }"
                  />
                  <div v-if="form.errors.district" class="invalid-feedback">
                    {{ form.errors.district }}
                  </div>
                </div>

                <div class="col-md-4 mb-3">
                  <label class="form-label">Cidade</label>
                  <input
                    v-model="form.city"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.city }"
                  />
                  <div v-if="form.errors.city" class="invalid-feedback">
                    {{ form.errors.city }}
                  </div>
                </div>

                <div class="col-md-2 mb-3">
                  <label class="form-label">UF</label>
                  <input
                    v-model="form.state"
                    type="text"
                    maxlength="2"
                    class="form-control text-uppercase"
                    :class="{ 'is-invalid': form.errors.state }"
                  />
                  <div v-if="form.errors.state" class="invalid-feedback">
                    {{ form.errors.state }}
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end mt-4">
                <button
                  type="submit"
                  class="btn btn-primary"
                  :disabled="form.processing"
                >
                  <span v-if="!form.processing">Finalizar cadastro</span>
                  <span v-else>
                    <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
                    Salvando...
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
