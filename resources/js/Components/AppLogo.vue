<script setup>
    import Logo from '../../images/app-logo.png';
    import {Link} from '@inertiajs/vue3';
</script>

<template>
  <div class="app-brand demo">
    <Link href="/" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img :src="Logo" alt="App Logo" srcset="" id="LogoApp" />
      </span>
      <span class="app-brand-text demo text-uppercase fw-bolder ms-2">KUIS</span>
    </Link>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
</template>
<style scoped>
  #logoApp{
    width: 30px;
  }
</style>

