<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import Container from '../../Components/Container.vue'
import Title from '../../Components/HeadingTitle.vue'
import InputField from '../../Components/InputField.vue'
import PrimaryBtn from '../../Components/PrimaryBtn.vue'
import TextAreaInput from '../../Components/TextAreaInput.vue';
import ImageUpload from '../../Components/ImageUpload.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';

const props = defineProps({
    listing: Object,
})

const form = useForm({
    title: props.listing.title,
    desc: props.listing.desc,
    tags: props.listing.tags,
    email: props.listing.email,
    link: props.listing.link,
    image: null,
    _method: 'PUT',
})
</script>
<template>

    <Head :title="$page.component.split('/')[1]" />
    <Container>
        <div class="mb-6">
            <Title>Edit your listing</Title>
        </div>
        <ErrorMessages :errors="form.errors" />
        <form @submit.prevent="form.post(route('listing.update', listing.id))">
            <div class="grid md:grid-cols-2 gap-6">
                <InputField label="Title" icon="heading" placeholder="My new listing" v-model="form.title" />
                <InputField label="Tags (separate with comma)" icon="tags" placeholder="one, two, three"
                    v-model="form.tags" />
                <InputField label="Email" icon="at" placeholder="example@email.com" v-model="form.email" />
                <InputField label="External Link" icon="up-right-from-square" placeholder="https://example.com"
                    v-model="form.link" />
                <TextAreaInput label="Description" icon="newspaper" placeholder="This is my listing description"
                    v-model="form.desc" />
                <ImageUpload @image="(a) => form.image = a" :listingImage="listing.image" />
            </div>
            <div class="mt-6">
                <PrimaryBtn :disabled="form.processing">Edit</PrimaryBtn>
            </div>
        </form>
    </Container>
</template>
