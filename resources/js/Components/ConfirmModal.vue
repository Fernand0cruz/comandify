<script setup>
import { defineProps, defineEmits } from "vue";
import PrimaryButton from "./PrimaryButton.vue";
import DangerButton from "./DangerButton.vue";

const props = defineProps({
    isVisible: Boolean,
    title: String,
    message: String,
});

const emit = defineEmits(["confirm", "cancel"]);

const onConfirm = () => emit("confirm");
const onCancel = () => emit("cancel");
</script>

<template>
    <div 
        class="modal fade" 
        :class="{ show: isVisible }" 
        :style="{ display: isVisible ? 'block' : 'none', backgroundColor: 'rgba(0, 0, 0, 0.5)' }" 
        tabindex="-1" 
        role="dialog" 
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="btn-close" @click="onCancel" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <p>{{ message }}</p>
                </div>
                
                <div class="modal-footer">
                    <PrimaryButton class="btn btn-secondary" @click="onCancel">Cancelar</PrimaryButton>
                    <DangerButton class="btn btn-danger" @click="onConfirm">Confirmar</DangerButton>
                </div>
            </div>
        </div>
    </div>
</template>
