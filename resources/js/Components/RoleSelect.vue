<script setup>
import { useForm } from '@inertiajs/vue3';
import Modal from './Modal.vue';
import { ref } from 'vue';
import SecondaryButton from './SecondaryButton.vue';
import PrimaryBtn from './PrimaryBtn.vue';
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
    <Modal maxWidth="lg" :show="confirmingSelection" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Change this user's role to {{ form.role }}?</h2>
            <div class="mt-6 flex justify-end gap-4">
                <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
                <PrimaryBtn @click="confirmSelected" class="w-fit">Aceptar</PrimaryBtn>
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
