<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AuthHeader from '@/Components/Auth/AuthHeader.vue'
import { ref, onMounted, computed, watch, nextTick } from 'vue'

const props = defineProps({
  email: String,
  user_id: Number,
})

const form = useForm({
  user_id: props.user_id,
  email: props.email,
  code: '',
})

const resendForm = useForm({ email: props.email })

// 6 dígitos separados
const codeDigits = ref(Array(6).fill(''))
const inputRefs = ref([])

// junta os dígitos em form.code sempre que mudar
watch(
  codeDigits,
  (val) => {
    form.code = val.join('')
  },
  { deep: true }
)

// e-mail mascarado no subtítulo (exa********@dominio.com)
const maskedEmail = computed(() => {
  if (!props.email) return ''
  const [user, domain] = props.email.split('@')
  if (!domain) return props.email

  const visible = user.slice(0, 2)
  const masked = '*'.repeat(Math.max(user.length - 2, 3))

  return `${visible}${masked}@${domain}`
})

// TIMER REENVIAR CÓDIGO
const counter = ref(30)
const canResend = ref(false)
let intervalId = null

const startTimer = () => {
  canResend.value = false
  counter.value = 30
  if (intervalId) clearInterval(intervalId)

  intervalId = setInterval(() => {
    if (counter.value <= 1) {
      canResend.value = true
      clearInterval(intervalId)
    } else {
      counter.value--
    }
  }, 1000)
}

// foco no primeiro campo + inicia timer
onMounted(() => {
  startTimer()
  nextTick(() => {
    if (inputRefs.value[0]) {
      inputRefs.value[0].focus()
    }
  })
})

const handleDigitInput = (index, event) => {
  const value = event.target.value.replace(/\D/g, '') // só número

  if (!value) {
    codeDigits.value[index] = ''
    return
  }

  // pega só o primeiro dígito digitado
  codeDigits.value[index] = value[0]

  // vai pro próximo campo automaticamente
  if (index < codeDigits.value.length - 1) {
    nextTick(() => {
      const next = inputRefs.value[index + 1]
      next && next.focus()
    })
  }
}

const handleBackspace = (index, event) => {
  if (codeDigits.value[index]) {
    // se tiver algo, apaga
    codeDigits.value[index] = ''
    return
  }

  // se estiver vazio, volta pro anterior
  if (index > 0) {
    event.preventDefault()
    const prev = inputRefs.value[index - 1]
    if (prev) {
      prev.focus()
      codeDigits.value[index - 1] = ''
    }
  }
}

const handlePaste = (event) => {
  const pasted = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6)
  if (!pasted) return

  for (let i = 0; i < 6; i++) {
    codeDigits.value[i] = pasted[i] || ''
  }

  // foca no último preenchido
  const lastIndex = Math.min(pasted.length - 1, 5)
  if (lastIndex >= 0) {
    nextTick(() => {
      const el = inputRefs.value[lastIndex]
      el && el.focus()
    })
  }
}

const submit = () => {
  form.post(route('login.code.check'))
}

const resend = () => {
  if (!canResend.value) return

  resendForm.post(route('login.code.send'), {
    onSuccess: () => {
      // limpa os campos e recomeça o timer
      codeDigits.value = Array(6).fill('')
      startTimer()
      nextTick(() => {
        inputRefs.value[0]?.focus()
      })
    },
  })
}
</script>

<template>
  <Head title="Verificar código" />

  <AuthLayout>
    <AuthHeader
      title="Enter the verification code"
      :subtitle="`An email containing a 6-digit verification code has been sent to the email address ${maskedEmail}.`"
    />

    <form @submit.prevent="submit">
      <div class="mb-4 text-center">
        <div
          class="d-flex justify-content-center align-items-center gap-2 flex-wrap"
          @paste.prevent="handlePaste"
        >
          <template v-for="(digit, index) in codeDigits" :key="index">
            <input
              type="text"
              maxlength="1"
              inputmode="numeric"
              autocomplete="one-time-code"
              class="form-control text-center code-input"
              v-model="codeDigits[index]"
              :ref="el => (inputRefs[index] = el)"
              @input="event => handleDigitInput(index, event)"
              @keydown.backspace="event => handleBackspace(index, event)"
            />

            <!-- traço entre o 3º e o 4º dígito, igual ao print -->
            <span v-if="index === 2" class="fs-4 mx-1">-</span>
          </template>
          <div v-if="form.errors.code" class="invalid-feedback d-block">
            {{ form.errors.code }}
          </div>
        </div>
      </div>

      <button
        type="submit"
        class="btn btn-primary w-100 mb-3"
        :disabled="form.processing || form.code.length !== 6"
      >
        <span v-if="!form.processing">Verify</span>
        <span v-else>
          <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
          Validating...
        </span>
      </button>
    </form>

    <div class="text-center mt-2">
      <button
        type="button"
        class="btn btn-link px-0"
        :disabled="!canResend || resendForm.processing"
        @click="resend"
      >
        <span v-if="resendForm.processing">
          <i class="fa-solid fa-arrows-rotate fa-spin me-2"></i>
          Reenviando...
        </span>

        <span v-else-if="!canResend">
          Reenviar em {{ counter }}s
        </span>

        <span v-else>Reenviar código</span>
      </button>
    </div>

    <p class="text-center mt-2 fs-9">
      Digitou o e-mail errado?
      <Link :href="route('login.code.request')">Corrigir</Link>
    </p>
  </AuthLayout>
</template>

<style scoped>
.code-input {
  width: 3rem;
  height: 3.2rem;
  font-size: 1.4rem;
  border-radius: 0.75rem;
}
</style>
