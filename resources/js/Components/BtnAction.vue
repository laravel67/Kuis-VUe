<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    color: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <!-- Gunakan binding class untuk menerapkan class dinamis -->
    <Link :href="href" :class="`btn btn-${color} mx-1`">
        <slot />
    </Link>
</template>
