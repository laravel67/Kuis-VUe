<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// Define props
const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  class: {
    type: String,
    default: 'menu-link',
  },
});

// Get current route path from usePage
const page = usePage();
const currentPath = page.url;
const isActive = computed(() => {
  return currentPath === props.href || currentPath.startsWith(props.href + '/');
});

const ClassSet = computed(() => {
  return isActive.value
    ? 'nav-item nav-link active'
    : 'nav-item nav-link';
});
</script>

<template>
    <Link :href="props.href" :class="ClassSet" aria-current="page">
      <slot />
    </Link>
</template>
