<script setup>
import { Head } from '@inertiajs/vue3'
import Card from '../Components/Card.vue';
import PaginationLinks from '../Components/PaginationLinks.vue';

defineProps({
    listings: Object,
})

</script>
<template>

    <Head title=" Latest Listings" />

    <div v-if="Object.keys(listings.data).length">
        <div class="grid grid-cols-3 gap-4">
            <div v-for="(listing, index) in listings.data" :key="index">
                <Card :listing="listing" />
            </div>
        </div>
        <div class="mt-8">
            <PaginationLinks :paginator="listings" />
        </div>
    </div>

</template>