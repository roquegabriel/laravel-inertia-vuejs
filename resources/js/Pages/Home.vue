<script setup>
import { Head } from '@inertiajs/vue3'
</script>
<template>

    <Head title="Home" />
    <h1 class="text-3xl text-center">Welcome!</h1>
    <!-- explicit style -->
    <font-awesome-icon :icon="['fas', 'phone']" />

    <!-- implicit style (fas is assumed) -->
    <font-awesome-icon icon="phone" />


</template>