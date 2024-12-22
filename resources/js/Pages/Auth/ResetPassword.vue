<script setup>

import Container from '../../Components/Container.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import Title from '../../Components/HeadingTitle.vue';

const props = defineProps({
    token: String,
    email: String,
})

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
})

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', "password_confirmation"),
    })
}

</script>
<template>

    <Head :title="$page.component.split('/')[1]" />
    <Container class="w-full sm:w-1/2 p-2">
        <div class="mb-8 text-center">
            <Title>Enter your new password</Title>
        </div>

        <!-- Errors messages -->
        <ErrorMessages :errors="form.errors" />
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Email" icon="at" v-model="form.email" />
            <InputField label="Password" type="password" icon="key" v-model="form.password" />
            <InputField label="Confirm Password" type="password" icon="key" v-model="form.password_confirmation" />
            <PrimaryBtn :disabled="form.processing">Reset Password</PrimaryBtn>
        </form>
    </Container>
</template>