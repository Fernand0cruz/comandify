<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: Number,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        type="number"
        class="form-control border rounded-0"
        v-model="model"
        ref="input"
        v-mask="['####']"
        autocomplete="off"
        min="1"
    />
</template>
