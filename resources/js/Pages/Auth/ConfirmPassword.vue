<script setup>
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';

defineProps({ status: String })

const form = useForm({
    password: "",
})

const submit = () => {
    form.post(route('confirm'), {
        onFinish: () => form.reset(),
    })
}
</script>
<template>

    <Head :title="$page.component.split('/')[1]" />

    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                This is a secure area of the application. Please confirm your password before continuing.
            </p>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form class="space-y-6" @submit.prevent="submit">
            <InputField label="Password" type="password" icon="key" v-model="form.password" />
            <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </form>
    </Container>
</template>