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
        autocomplete="off"
        min="0"
    />
</template>

<style scoped>
input:focus {
    border-color: #343a40 !important;  
    outline: none !important; 
    box-shadow: none !important;  
}
</style>
