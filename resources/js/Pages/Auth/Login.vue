<script setup>
import { Link } from '@inertiajs/vue3';
import App from '@Layout/App.vue';
import Input from '../../Components/Input.vue';
</script>

<template>
    <App title="Login">
        <form action="" method="post" class="mb-3">
            <Input v-model="email" type="email" placeholder="alamat email">Alamat Email</Input>
            <Input v-model="email" type="email" placeholder="Kata Sandi">Kata Sandi</Input>
        </form>
        <p class="text-center">
            <Link href="/register"><span>Daftar Akun ?</span></Link> /
            <Link href="/register"><span>Lupa Sandi ?</span></Link>
        </p>
    </App>
</template>