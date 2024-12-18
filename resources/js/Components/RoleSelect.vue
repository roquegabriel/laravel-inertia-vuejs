<script setup>
import { useForm } from '@inertiajs/vue3';
import Modal from './Modal.vue';
import { ref } from 'vue';
const props = defineProps({
    user: Object
})

const form = useForm({
    role: props.user.role
})
const confirmingSelection = ref(false)
const confirmSelected = () => {
    form.put(route('admin.role', props.user.id))
}
const closeModal = () => {
    confirmingSelection.value = false;
    form.role = props.user.role
}

const showModal = () => {
    confirmingSelection.value = true
}
</script>
<template>
    <!-- Modal -->
    <Modal :show="confirmingSelection" @close="closeModal">
        <div class="p-6">
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-lg font-medium text-gray-900">Change this user's role to {{ form.role }}?</h2>
                <div class="mt-3">
                    <button @click="closeModal"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        Cancel
                    </button>
                    <button
                        class="ms-3 inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-xs font-semibold uppercase text-white transition duration-150 ease-in-out hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 active:bg-green-700"
                        @click="confirmSelected">
                        Accept
                    </button>
                </div>
            </div>
        </div>
    </Modal>

    <div class="flex items-center gap-2">
        <form @change="showModal" class="flex items-center gap-2">
            <label for="roles" class="sr-only">Roles</label>
            <select v-model="form.role" name="roles"
                class="text-slate-800 bg-slate-200 text-xs py-1 border-0 outline-0 rounded-lg">
                <option value="admin">Admin</option>
                <option value="general">General</option>
                <option value="suspended">Suspended</option>
            </select>
        </form>
    </div>
</template>
