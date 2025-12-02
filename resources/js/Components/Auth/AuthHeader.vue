<script setup>
    const props = defineProps({
        title: { type: String, required: true },
        subtitle: { type: String, required: false, default: '' },
    })
</script>

<template>
  <div class="w-100 d-flex flex-column justify-content-center align-items-center mb-4 text-center">
        <img src="/assets/img/favicons/apple-touch-icon.png" alt="" width="60" class="mb-2" />

        <h3 class="mb-1">{{ title }}</h3>

        <p v-if="subtitle" class="text-body-secondary mb-0">
            {{ subtitle }}
        </p>
  </div>
</template>
