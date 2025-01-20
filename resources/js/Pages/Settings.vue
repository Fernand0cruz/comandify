<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const isModalVisible = ref(false);
const loading = ref(false);

const form = useForm({});

const openDeleteModal = () => {
    isModalVisible.value = true;
};

const closeDeleteModal = () => {
    isModalVisible.value = false;
};

const confirmDelete = () => {
    
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Configurações</h2>
            </div>
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <h5 class="card-title">Apagar comandas do sistema</h5>
                    <p class="card-text">
                        Apague todas as comandas do sistema. Esta ação não pode
                        ser desfeita.
                    </p>
                    <DangerButton @click="openDeleteModal">
                        Apagar Comandas
                    </DangerButton>
                </div>
            </div>
            <ConfirmModal
                :isVisible="isModalVisible"
                title="Confirmar Exclusão"
                message="Você tem certeza que deseja excluir todos os dados das comandas registradas? Esta ação não pode ser desfeita."
                @confirm="confirmDelete"
                @cancel="closeDeleteModal"
            />
        </div>
    </AuthenticatedLayout>
</template>
