<script setup>
import MenuLink from './MenuLink.vue';

// Emit an event when the sidebar toggle button is clicked
const emit = defineEmits(['toggle-sidebar']);
</script>

<template>
  <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
      <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <!-- Tombol Ini Gunakan Untuk Menampilkan Sidebar -->
    <a href="#" class="sidebar-toggler flex-shrink-0" @click.prevent="emit('toggle-sidebar')">
      <i class="fa fa-bars"></i>
    </a> 
    <div class="navbar-nav align-items-center ms-auto">
      <!-- Your Navbar Content Here -->
    </div>
  </nav>
</template>
