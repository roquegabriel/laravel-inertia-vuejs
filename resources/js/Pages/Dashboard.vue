<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Title from '../Components/HeadingTitle.vue'
import PaginationLinks from '../Components/PaginationLinks.vue'
import Modal from '../Components/Modal.vue';
import SessionMessages from '../Components/SessionMessages.vue';
import { ref } from 'vue';
defineProps({
    listings: Object,
    status: String
})
let userId = null
const confirmingUserDeletion = ref(false);
const confirmUserDeletion = (id) => {
    confirmingUserDeletion.value = true;
    userId = id
};
const closeModal = () => {
    confirmingUserDeletion.value = false;

}
const deleteUser = () => {
    router.delete(route('listing.destroy', userId), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

</script>
<template>
    <!-- Modal -->
    <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete your listing?
            </h2>
            <div class="mt-6 flex justify-end">
                <button @click="closeModal"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                    Cancel
                </button>

                <button
                    class="ms-3 inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700"
                    @click="deleteUser">
                    Delete
                </button>
            </div>
        </div>
    </Modal>

    <SessionMessages :status="status" />

    <Head :title="$page.component" />
    <div v-if="listings">

        <div v-if="Object.keys(listings.data).length">
            <div class="mb-6">
                <!-- Heading -->
                <div class="flex items-center justify-between mb-4">
                    <Title>Your latest listings</Title>
                    <div class="flex items-center gap-4 text-xs">
                        <p>Approved <font-awesome-icon icon="check-circle" class="text-green-500" /></p>
                        <p>Pending approved <font-awesome-icon icon="circle-xmark" class="text-red-500" /></p>
                    </div>
                </div>
                <!-- Table -->
                <table
                    class="w-full table-fixed border-collapse overflow-hidden rounded-md text-sm ring-1 ring-slate-300 dark:ring-slate-600 bg-white shadow-lg">
                    <thead class="bg-slate-300 text-xs uppercase text-slate-600 dark:text-slate-400 dark:bg-slate-900">
                        <tr>
                            <th class="w-3/4 p-3 text-left">Listing title</th>
                            <th class="w-1/4 py-3 pr-3 text-right">View</th>
                            <th class="w-1/5 py-3 pr-3 text-right">Edit</th>
                            <th class="w-1/5 py-3 pr-3 text-right">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="listing in listings.data" :key="listing.id"
                            class="border-b border-slate-200 hover:bg-slate-100 dark:bg-slate-800 dark:hover:bg-slate-600 dark:border-slate-600">
                            <td class="w-3/4 p-3 text-left">
                                <div class="flex items-center gap-2">
                                    <img :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.png`"
                                        class="size-10 rounded-full object-cover object-center" alt="">
                                    <h4>{{ listing.title }} <font-awesome-icon
                                            :icon="`${listing.approved ? 'circle-check' : 'circle-xmark'}`"
                                            :class="{ 'text-green-500': listing.approved, 'text-red-500': !listing.approved }" />
                                    </h4>
                                </div>
                            </td>
                            <td class="w-1/4 py-3 pr-3 text-right text-indigo-500">
                                <Link v-if="listing.approved" :href="route('listing.show', listing.id)">
                                View
                                </Link>
                            </td>
                            <td class="w-1/4 py-3 pr-3 text-right text-indigo-500">
                                <Link :href="route('listing.edit', listing.id)">
                                Edit
                                </Link>
                            </td>
                            <td class="w-1/4 py-3 pr-3 text-right text-red-500">
                                <button @click="confirmUserDeletion(listing.id)" type="button">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <PaginationLinks :paginator="listings" />
            </div>
        </div>
        <div v-else>
            <p>You have no listings!</p>
        </div>
    </div>
    <div v-else>
        <p>Due to violation of our terms your account has been suspended, please contact us at <span
                class="text-link">email@admin.com</span></p>
    </div>
</template>
