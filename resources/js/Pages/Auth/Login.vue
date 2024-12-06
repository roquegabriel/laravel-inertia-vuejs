<script setup>
import TextLink from '../../Components/TextLink.vue';
import Title from '../../Components/Title.vue';
import Container from '../../Components/Container.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import CheckBox from '../../Components/CheckBox.vue';

const form = useForm({
    email: "",
    password: "",
    remember: null,
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>
<template>

    <Head :title="$page.component.split('/')[1]" />

    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Log in to your account</Title>
            <p>Need an account?
                <TextLink routeName="register" label="Register" />
            </p>
        </div>

        <!-- Errors messages -->
        <ErrorMessages :errors="form.errors" />
        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Email" icon="at" v-model="form.email" />
            <InputField label="Password" type="password" icon="key" v-model="form.password" />
            <PrimaryBtn :disabled="form.processing">Login</PrimaryBtn>

            <div class="flex items-center justify-between">
                <CheckBox name="remember" v-model="form.remember">Remember me</CheckBox>
                <TextLink label="Forgot password?" routeName="home" />
            </div>

        </form>
    </Container>
</template>