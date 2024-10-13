<script setup>
import { ref, defineProps, defineEmits, computed } from 'vue';

// Define props
const props = defineProps({
  modelValue: {
    type: String,
    default: '',
  },
  id: {
    type: String,
    default: '',
  },
  name: {
    type: String,
    default: '',
  },
  placeholder: {
    type: String,
    default: '',
  },
  type: {
    type: String,
    default: 'text',
  },
  error: {
    type: String,
    default: '',
  }
});

// Define emits
const emit = defineEmits(['update:modelValue']);

// Reactive state for the input value
const inputValue = ref(props.modelValue);

// Watch for changes in inputValue and emit them
const updateValue = () => {
  emit('update:modelValue', inputValue.value);
};

// Computed property to determine if the input is invalid
const isInvalid = computed(() => props.error !== '');
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="form-label text-capitalize">
      <slot/>
    </label>
    <input
      :type="type"
      :class="['form-control', { 'is-invalid': isInvalid }]"
      :id="id"
      :name="name"
      :placeholder="placeholder"
      v-model="inputValue"
      @input="updateValue"
    />
    <span v-if="isInvalid" class="text-danger">{{ props.error }}</span>
  </div>
</template>
