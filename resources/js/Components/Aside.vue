<template>
  <div class="container-xxl position-relative bg-white d-flex p-0">
    <!-- Sidebar -->
    <div :class="['sidebar', 'pe-4', 'pb-3', { 'open': isSidebarVisible }]">
      <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
          <h3 class="text-primary">
            <img :src="Logo" alt="Logo" width="30px">
            KUIZ
          </h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
          <div class="position-relative">
            <img class="rounded-circle" src="img/user.jpg" alt="User" style="width: 40px; height: 40px;">
            <div class="bg-success rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
          </div>
          <div class="ms-3">
            <h6 class="mb-0">Murtaki admin</h6>
            <span>Admin</span>
          </div>
        </div>
        <div class="navbar-nav w-100">
          <a class="nav-item nav-link active" href="/">
            <i class="fa fa-tachometer-alt me-2"></i>Dashboard
          </a>
        </div>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="content" :class="{ 'open': !isSidebarVisible }">
      <navbar @toggle-sidebar="toggleSidebar" />
      <div class="container-fluid pt-4 px-4">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Logo from '../../images/app-logo.png';

const props = defineProps({
  title: String,
  namepage: String,
});

const { appName, url } = usePage().props;

const Title = computed(() => `${appName} | ${props.title}`);
const isSidebarVisible = ref(false);

const toggleSidebar = () => {
  isSidebarVisible.value = !isSidebarVisible.value;
};

</script>

<style scoped>
/* Importing or defining the CSS styles from your previous code here */

:root {
  --primary: #009CFF;
  --light: #F3F6F9;
  --dark: #191C24;
}

/* Spinner, Button, Layout, Navbar, Date Picker, Testimonial, etc. from the provided CSS */

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 250px;
  height: 100vh;
  overflow-y: auto;
  background: var(--light);
  transition: 0.5s;
  z-index: 999;
}

.content {
  margin-left: 250px;
  min-height: 100vh;
  background: #FFFFFF;
  transition: 0.5s;
}

@media (max-width: 991.98px) {
  .sidebar {
    margin-left: -250px;
  }

  .sidebar.open {
    margin-left: 0;
  }

  .content {
    width: 100%;
    margin-left: 0;
  }
}
</style>
