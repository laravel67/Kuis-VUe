
<script setup>
import { ref, computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Aside from '@Components/Aside.vue';
import Navbar from '../Components/Navbar.vue';
import Logo from '../../images/app-logo.png';

// Define props using `defineProps` for <script setup>
const props = defineProps({
  title: {
    type: String,
    required: true
  },
  namepage: {
    type: String,
    default: ''
  }
});

console.log('Props:', props);
const { appName } = usePage().props;

// Compute the full title for the page
const Title = computed(() => {
  return `${appName} | ${props.title}`;
});

// Manage the sidebar visibility state
const isAsideVisible = ref(false);

function toggleAside() {
  isAsideVisible.value = !isAsideVisible.value;
}

// Set the sidebar visibility state
const setAsideVisible = (visibility) => {
  isAsideVisible.value = visibility;
}
</script>

<template>
  <!-- Use the Head component for setting the title -->
  <Head :title="Title" />
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Pass the isAsideVisible prop to the Aside component -->
      <Aside :isVisible="isAsideVisible" @update:isVisible="setAsideVisible"/>
      <div class="layout-page" :class="{ 'layout-page-with-sidebar': isAsideVisible }">
        <!-- Navbar with a toggle button for the sidebar -->
        <Navbar @toggle-aside="toggleAside" />
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4 align-items-center">
              <img :src="Logo" alt="App Logo" srcset="" id="LogoApp" /> 
              <span class="text-success">KUIS.ID </span>
              <span class="text-muted fw-light text-capitalize">/{{ namepage }}</span>
            </h4>
            <slot/>
          </div>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
#LogoApp {
  width: 22px;
}

/* Adjust content padding based on sidebar visibility */
.layout-page {
  transition: margin-left 0.3s ease-in-out;
}

.layout-page-with-sidebar {
  margin-left: 250px; /* Adjust based on the width of your sidebar */
}

@media (max-width: 991px) {
  .layout-page {
    margin-left: 0; /* No margin when sidebar is hidden on small screens */
  }
}
</style>
