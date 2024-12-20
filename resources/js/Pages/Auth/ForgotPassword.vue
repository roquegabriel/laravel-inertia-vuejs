<script setup>
import Container from '../../Components/Container.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import SessionMessages from '../../Components/SessionMessages.vue';

defineProps({ status: String })

const form = useForm({
    email: "",
})

const submit = () => {
    form.post(route('password.email'))
}
</script>
<template>

    <Head :title="$page.component.split('/')[1]" />

    <Container class="w-full md:w-1/2 p-2">

        <div class="mb-8 text-center">
            <p>Forgot your password? No problem. Just let us know your email address and we will email you a password
                reset link that will allow you to choose a new one.</p>
        </div>

        <!-- Errors messages -->
        <ErrorMessages :errors="form.errors" />
        <!-- Flash message -->
        <SessionMessages :status="status" />

        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Email" icon="at" v-model="form.email" />

            <PrimaryBtn :disabled="form.processing">Send Password Reset Link</PrimaryBtn>

        </form>
    </Container>
</template>