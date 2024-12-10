<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { switchTheme } from '../theme';
import NavLink from '../Components/NavLink.vue';
import { computed, ref } from 'vue';

const page = usePage()
const user = computed(() => page.props.auth.user)

const show = ref(false)

</script>

<template>
    <!-- Overlay -->
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>

    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg space-x-5 flex justify-between items-center">
            <NavLink routeName="home" componentName="Home">
                Home
            </NavLink>
            <div class="flex items-center space-x-6">
                <div v-if="user" class="relative">
                    <div @click="show = !show"
                        class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor-pointer"
                        :class="{ 'bg-slate-700': show }">
                        <p>{{ user.name }}</p>
                        <font-awesome-icon icon="angle-down" />
                    </div>
                    <!-- User dropdown menu -->
                    <div v-show="show" @click="show = false"
                        class="bg-slate-800 absolute z-50 top-16 righ-0 border overflow-hidden w-40 rounded-lg">
                        <Link class="block w-full px-6 py-3 hover:bg-slate-700 text-left" :href="route('profile.edit')">
                        Profile</Link>
                        <Link class="block w-full px-6 py-3 hover:bg-slate-700 text-left" :href="route('dashboard')">
                        Dashboard</Link>
                        <Link as="button" method="post" :href="route('logout')"
                            class="block w-full px-6 py-3 hover:bg-slate-700 text-left">Logout</Link>
                    </div>
                </div>
                <!-- Guest -->
                <div v-else class="space-x-6">
                    <NavLink routeName="login" componentName="Auth/Login">
                        Login
                    </NavLink>
                    <NavLink routeName="register" componentName="Auth/Register">
                        Register
                    </NavLink>
                </div>
                <button @click="switchTheme"
                    class="hover:bg-slate-700 size-6 grid place-content-center  rounded-full hover:outline outline-1 outline-white">
                    <font-awesome-icon :icon="['fas', 'circle-half-stroke']" />
                </button>
            </div>
        </nav>
    </header>
    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>