<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
  options: {
    type: Array,
    required: true,
  },
  modelValue: {
    type: [String, Number],
    default: '',
  },
  error: {
    type: String,
    default: '',
  }
});

const emit = defineEmits(['update:modelValue']);

// Ref for handling v-model
const modelValue = ref(props.modelValue);

const isErrors = computed(() => props.error.length > 0);

const ClassSet = computed(() => {
  return isErrors.value
    ? 'bg-gray-50 border border-red-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
    : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-md p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
});

// Watch for changes in the modelValue and emit updates
watch(modelValue, (newValue) => {
  emit('update:modelValue', newValue);
});
</script>

<template>
  <div class="px-2">
    <select 
      :class="ClassSet" 
      v-model="modelValue"
    >
      <option value="">==Pilih Tingkat==</option>
      <option v-for="opt in options" :key="opt.id" :value="opt.id">
        {{ opt.name }}
      </option>
    </select>
    <span v-if="error" class="text-red-800">{{ error }}</span>
  </div>
</template>
