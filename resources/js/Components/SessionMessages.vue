<template>
    <div v-if="status" class="mb-4 font-medium text-sm text-green-500">
        {{ status }}
    </div>
</template>
<script>
export default {
    props: ['status']

}
</script>