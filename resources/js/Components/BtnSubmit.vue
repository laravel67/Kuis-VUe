<!-- resources/js/components/BtnSubmit.vue -->
<template>
    <button type="submit" :class="`btn btn-success me-2 ${buttonClass}`" :disabled="isLoading">
      <span v-if="!isLoading">{{ text }}</span>
      <div v-if="isLoading" class="spinner-border spinner-border-sm text-info ms-2" role="status">
        <span class="visually-hidden">{{ loadingText }}</span>
      </div>
      <span v-if="isLoading">{{ loadingText }}</span>
    </button>
  </template>
  <script setup>
  import { ref } from 'vue';
  
  const props = defineProps({
    text: {
      type: String,
      default: 'Simpan',
    },
    loadingText: {
      type: String,
      default: 'Menyimpan...',
    },
    buttonClass: {
      type: String,
      default: '',
    },
  });
  const isLoading = ref(false);
  const simulateSubmit = async () => {
    isLoading.value = true;
    await new Promise(resolve => setTimeout(resolve, 2000));
    isLoading.value = false;
  };
  </script>
  