<script setup>
import { ref, onMounted, defineProps, defineEmits, defineExpose } from "vue";

const model = defineProps({
    modelValue: {
        type: [String, Number],
        required: true,
    },
});

const emit = defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({
    focus: () => input.value.focus(),
});

const onInput = (event) => {
    let value = event.target.value;
    const numericValue = value.replace(/[^\d,]/g, "");
    const formattedValue = numericValue.replace(",", ".");
    emit("update:modelValue", parseFloat(formattedValue));
};
</script>

<template>
    <input
        class="form-control border rounded-0"
        v-bind="model"
        ref="input"
        :value="model.modelValue"
        @input="onInput"
        v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##', 'R$ #.###,##']"
        placeholder="R$ 0,00"
        autocomplete="off"
    />
</template>
<style scoped>
input:focus {
    border-color: #343a40 !important;
    outline: none !important;
    box-shadow: none !important;
}
</style>
