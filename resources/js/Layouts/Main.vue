<script setup>
import { Link } from '@inertiajs/vue3'
import { switchTheme } from '../theme';
</script>

<template>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg space-x-5 flex justify-between items-center">
            <Link  href="/" class="text-3xl" :class="{ 'bg-gray-900 px-2 py-1 rounded-md': $page.component==='Home' }">Home</Link>
            <div>
                <button @click="switchTheme" class="hover:bg-slate-700 size-6 grid place-content-center  rounded-full hover:outline outline-1 outline-white">
                    <font-awesome-icon :icon="['fas', 'circle-half-stroke']" />
                </button>
            </div>
        </nav>
    </header>
    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>