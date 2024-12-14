<script setup>
import { ref } from 'vue';

const emit = defineEmits(['image'])

const preview = ref(null)
const oversizedImage = ref(null)

const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0])
    oversizedImage.value = e.target.files[0].size > 3145728
    emit('image', e.target.files[0])
}

</script>
<template>
    <div>
        <span :class="{ '!text-red-500': oversizedImage }"
            class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            {{ oversizedImage ? 'The selected image exceeds 3 MB' : 'Image (Max size 3MB)' }}
        </span>
        <label :class="{ '!border-red-500': oversizedImage }" for="image"
            class="block rounded-md mt-1 bg-slate-300 h-[140px] overflow-hidden cursor-pointer border-slate-300 border">
            <img :src="preview ?? '/storage/images/listing/default.png'" class="object-cover object-center h-full w-full" alt="">
        </label>
        <input @input="imageSelected" type="file" name="image" id="image" hidden>
    </div>
</template>
