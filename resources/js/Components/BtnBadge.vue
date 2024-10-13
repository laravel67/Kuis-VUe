<script setup>
import { Link } from '@inertiajs/vue3';

// Mendefinisikan props menggunakan defineProps
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    bgClass: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <!-- Gunakan binding class untuk menerapkan class dinamis -->
    <Link :href="href" :class="`badge bg-${bgClass} mb-3`">
        <slot />
    </Link>
</template>
