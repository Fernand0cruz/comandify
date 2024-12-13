<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="fs-6 text-red-600">
            {{ message }}
        </p>
    </div>
</template>
