<script setup>
import { Link } from '@inertiajs/vue3';

const props=defineProps({
    href:{
        type:String,
        required:true,
    }
});

</script>
<template>
    <Link :href="props.href" class="
    px-3 py-2 mx-1 text-xs font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-green-700 dark:focus:ring-blue-800
    ">
        <slot/>
    </Link>
    <!-- <Link :href="props.href" class="btn btn-success mb-3"><i class="bx bx-plus-circle me-1"></i> Tambah</Link> -->
</template>