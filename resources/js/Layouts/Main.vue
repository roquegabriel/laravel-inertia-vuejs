<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <header class="bg-gray-800 text-white h-16 flex justify-start items-center">
        <nav class="space-x-5">
            <Link href="/" class="text-3xl">Home</Link>
            <Link :href="route('about')" class="text-3xl">About</Link>
        </nav>
    </header>
    <main>
        <slot />
    </main>
</template>