<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block fs-6 fw-medium text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
