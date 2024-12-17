<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute('autofocus')) {
        textarea.value.focus();
    }
});

defineExpose({
    focus: () => textarea.value.focus(),
});
</script>

<template>
    <textarea
        class="form-control border rounded-0"
        v-model="model"
        ref="textarea"
        rows="4" 
        autocomplete="off"
    ></textarea>
</template>

<style scoped>
textarea:focus {
    border-color: #343a40 !important;  
    outline: none !important; 
    box-shadow: none !important;  
    resize: none;
}
</style>
