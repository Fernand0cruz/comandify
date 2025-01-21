<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import { ref, toRefs } from "vue";
import { useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";

const props = defineProps({
    flash: Object,
});

const isModalVisible = ref(false);
const { flash } = toRefs(props);

const form = useForm({});

const openDeleteModal = () => {
    isModalVisible.value = true;
};

const closeDeleteModal = () => {
    isModalVisible.value = false;
};

const showToast = (message, type = "success") => {
    const options = {
        theme: "dark",
        position: "bottom-center",
        transition: "flip",
    };
    type === "success"
        ? toast.success(message, options)
        : toast.error(message, options);
};

const confirmDelete = () => {
    // form.delete(route('all-order-slips.delete'), {
    form.delete(route("order-slips.delete-all"), {
        onSuccess: () => {
            showToast(flash.value?.success);
            closeDeleteModal();
        },
        onError: (erro) => {
            showToast("Ocorreu um erro. Por favor, tente novamente.", "error"),
                console.error(erro);
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Configurações</h2>
            </div>
            <div class="card shadow-sm">
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
