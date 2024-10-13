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
    <Link :href="props.href" class="focus:outline-none text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        <slot/>
    </Link>
    <!-- <Link :href="props.href" class="btn btn-success mb-3"><i class="bx bx-plus-circle me-1"></i> Tambah</Link> -->
</template>