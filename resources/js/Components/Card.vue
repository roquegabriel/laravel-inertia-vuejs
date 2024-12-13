<script setup>
import { Link, router } from '@inertiajs/vue3';

const params = route().params;

defineProps({
    listing: Object,
})
const selectUser = (id) => {
    router.get(route('home'), { user_id: id, search: params.search})
}
</script>
<template>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden dark:bg-slate-800 h-full flex flex-col justify-between">
        <div>
            <!-- Image -->
            <Link href="">
            <img :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.png`"
                :alt="listing.image" class="w-full h-48 object-contain object-center bg-slate-300">
            </Link>

            <!-- Title & user -->
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2 line-clamp-3">{{ listing.title }}...</h3>
                <p>Listed on {{ new Date(listing.created_at).toLocaleDateString() }}</p>
                by <button @click="selectUser(listing.user.id)" class="text-link">{{ listing.user.name }}</button>
            </div>
        </div>
        <!-- Tags -->
        <div v-if="listing.tags" class="flex items-center gap-3 px-4 pb-4">
            <div v-for="(tag, index) in listing.tags.split(',')" :key="index"
                class="bg-slate-500 text-white px-2 py-px rounded-full hover:bg-slate-700 dark:hover:bg-slate-900">
                {{ tag }}
            </div>
        </div>
    </div>
</template>
