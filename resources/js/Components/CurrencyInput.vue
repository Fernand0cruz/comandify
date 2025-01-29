<script setup>
import { ref, computed } from 'vue';

const model = defineModel({
    type: [String, Number],
    required: true,
}); 

const input = ref(null);

const formattedValue = computed({
    get: () => model.value ? formatCurrency(model.value) : '',
    set: (val) => {
        const numericValue = parseFloat(val.replace(/[^\d]/g, '')) / 100;
        model.value = isNaN(numericValue) ? 0 : numericValue;
    }
});

function formatCurrency(value) {
    return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
        minimumFractionDigits: 2
    }).format(value);
}

function preventNonNumeric(event) {
    const allowedKeys = ["Backspace", "Tab", "ArrowLeft", "ArrowRight", "Delete"];
    if (!/\d/.test(event.key) && !allowedKeys.includes(event.key)) {
        event.preventDefault();
    }
}
</script>

<template>
    <input
        type="text"
        class="form-control border rounded-0"
        v-model="formattedValue"
        ref="input"
        autocomplete="off"
        placeholder="R$ 00,00"
        @keypress="preventNonNumeric"
    />
</template>
