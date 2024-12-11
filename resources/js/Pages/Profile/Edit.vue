<script setup>
import { Head } from '@inertiajs/vue3'
import UpdateInfo from './Sections/UpdateInfo.vue';
defineProps({ user: Object, status: String })
</script>
<template>

    <Head :title="$page.component.split('/')[1]" />
    <UpdateInfo :user="user" :status="status"/>
</template>