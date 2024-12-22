<script setup>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import Container from "../../Components/Container.vue";
import { computed, ref } from "vue";
import Modal from "../../Components/Modal.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import DangerButton from "../../Components/DangerButton.vue";

const page = usePage()
const admin = computed(() => page.props.auth.user && page.props.auth.user.role === 'admin')

const props = defineProps({
    listing: Object,
    user: Object,
    canModify: Boolean
})


const confirmingUserDeletion = ref(false);
const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};
const closeDeleteModal = () => {
    confirmingUserDeletion.value = false;

}
const deleteUser = () => {
    router.delete(route('listing.destroy', props.listing.id), {
    });
};
const closeModal = () => {
    showModal.value = false
}
const showModal = ref(false)
const toggleApprove = () => {
    router.put(route('admin.approve', props.listing.id), {}, {
        onSuccess: () => closeModal()
    })
}

</script>
<template>
    <!-- Admin -->
    <!-- Modal for updating role-->
    <Modal maxWidth="lg" :show="showModal" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ listing.approved ? 'Disapprove' : 'Approve' }} this listing?
            </h2>
            <div class="mt-6 flex justify-end gap-4">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryBtn @click="toggleApprove" class="!w-fit">Aceptar</PrimaryBtn>
            </div>
        </div>
    </Modal>
    <!-- Modal for deleting-->
    <Modal maxWidth="lg" :show="confirmingUserDeletion" @close="closeDeleteModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete your listing?
            </h2>
            <div class="mt-6 flex justify-end gap-4">
                <SecondaryButton @click="closeDeleteModal">Cancel</SecondaryButton>
                <DangerButton @click="deleteUser">Delete</DangerButton>
            </div>
        </div>
    </Modal>

    <Head title=" Listing detail" />
    <!-- Admin -->
    <div v-if="admin" class="bg-slate-800 text-white mb-6 p-6 rounded-md font-medium flex items-center justify-between">
        <p>This listing is {{ listing.approved ? 'approved' : 'disapproved' }}</p>
        <button @click.prevent="showModal = true" class="bg-slate-600 px-3 py-1 rounded-md">{{ listing.approved ?
            'Disapprove it' : 'Approve it' }}</button>
    </div>
    <Container class="flex gap-4 flex-wrap justify-center md:flex-nowrap">
        <div class="w-1/2 sm:w-1/4 rounded-md overflow-hidden">
            <img :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.png`" alt=""
                class="w-full h-full object-cover object-center">
        </div>
        <div class="w-3/4">
            <!-- Listing info -->
            <div class="mb-6">
                <div class="flex items-center sm:items-end justify-between mb-2">
                    <p class="text-slate-400 w-full border-b">Listing detail</p>
                    <!-- Edit and delete  -->
                    <div v-if="canModify" class="pl-4 flex sm:flex-row items-center gap-2 flex-col">
                        <Link :href="route('listing.edit', listing.id)"
                            class="bg-green-500 rounded-md text-white px-6 py-2 hover:outline outline-green-500 outline-offset-2">
                        Edit</Link>
                        <button @click="confirmUserDeletion"
                            class="bg-red-500 rounded-md text-white px-6 py-2 hover:outline outline-red-500 outline-offset-2">
                            Delete
                        </button>
                    </div>
                </div>
                <h3 class="font-bold text-2xl mb-4">{{ listing.title }}</h3>
                <p>{{ listing.desc }}</p>
            </div>

            <!-- Contact info -->
            <div class="mb-6">
                <p class="text-slate-400 w-full border-b mb-2">Contact info</p>
                <!-- Email -->
                <div v-if="listing.email" class="flex items-center mb-2 gap-2 flex-wrap">
                    <font-awesome-icon icon="at" />
                    <p>Email:</p>
                    <a :href="`mailto:${listing.email}`" class="text-link">{{ listing.email }}</a>
                </div>
                <!-- Link -->
                <div v-if="listing.link" class="flex items-center mb-2 gap-2 flex-wrap">
                    <font-awesome-icon icon="up-right-from-square" />
                    <p>External Link:</p>
                    <a :href="listing.link" target="_blank" class="text-link">{{ listing.link }}</a>
                </div>
                <!-- User -->
                <div class="flex items-center mb-2 gap-2 flex-wrap">
                    <font-awesome-icon icon="user" />
                    <p>Listed by:</p>
                    <Link :href="route('home', { user_id: user.id })" class="text-link">{{ user.name }}</Link>
                </div>
            </div>
            <div v-if="listing.tags" class="mb-6">
                <p class="text-slate-400 w-full border-b mb-2">Tags</p>
                <div class="flex items-center gap-3">
                    <div v-for="(tag, index) in listing.tags.split(',')" :key="index">
                        <Link :href="route('home', { tag })"
                            class="bg-slate-500 text-white px-2 py-px rounded-full hover:bg-slate-700 dark:hover:bg-slate-900">
                        {{ tag }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Container>
</template>