<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ClipboardCheck } from "lucide-vue-next";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import { toRefs, onMounted } from "vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import { ref } from "vue";

const props = defineProps({
    orderSlips: Array,
    flash: Object,
});

const form = useForm({});
const { flash } = toRefs(props);
const isModalVisible = ref(false);
const orderSlipToDelete = ref(null);

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

onMounted(() => {
    if (flash.value?.success) {
        showToast(flash.value.success);
        flash.value.success = null;
    }
    if (flash.value?.error) {
        console.log("Erro:", flash.value.error);
        showToast(flash.value.error, "error");
        flash.value.error = null;
    }
});

const openDeleteModal = (orderSlip) => {
    orderSlipToDelete.value = orderSlip;
    isModalVisible.value = true;
};

const cancelDelete = () => {
    orderSlipToDelete.value = null;
    isModalVisible.value = false;
};

const confirmDelete = () => {
    if (orderSlipToDelete.value) {
        form.delete(route("order-slips.destroy", orderSlipToDelete.value.id), {
            onSuccess: () => {
                form.get(route("order-slips.index"));
                orderSlipToDelete.value = null;
                showToast(flash.value.success);
                flash.value.success = null;
            },
            onError: (erro) => {
                console.error(erro);
            },
        });
    }
    isModalVisible.value = false;
};
function formatCurrency(value) {
    return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
    }).format(value);
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Comandas</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Comandas abertas: {{ props.orderSlips.length }}</span>
                    <Link
                        :href="route('order-slips.create')"
                        class="inline-flex btn btn-dark rounded-1 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                    >
                        <ClipboardCheck />
                        Criar Comanda
                    </Link>
                </div>
            </div>
            <div class="card shadow-sm p-3" v-if="props.orderSlips.length === 0">
                Não há comandas abertas no momento.
            </div>
            <div v-else class="row g-3">
                <div
                    class="col-md-12 col-lg-4"
                    v-for="(orderSlip, index) in props.orderSlips"
                    :key="index"
                >
                    <div class="card shadow-sm p-3">
                        <div
                            class="bg-dark rounded-1 p-3 d-flex justify-content-between"
                        >
                            <span class="fs-5 fw-bold text-white">
                                Comanda #{{ orderSlip.order_number }}
                            </span>
                            <span class="fs-5 fw-bold text-white">
                                Mesa #{{ orderSlip.table_number }}
                            </span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fs-5 fw-bold">
                                {{ orderSlip.customer_name }}
                            </span>
                            <ul
                                class="overflow-auto list-group list-group-flush"
                                style="max-height: 200px; min-height: 200px"
                            >
                                <li
                                    class="py-1 border-top d-flex justify-content-between"
                                    v-for="(
                                        product, index
                                    ) in orderSlip.products"
                                    :key="index"
                                >
                                    <span
                                        >{{ product.pivot.quantity }} x
                                        {{ product.name }} -
                                        {{
                                            formatCurrency(product.price)
                                        }}</span
                                    >
                                    <span class="fw-bold">
                                        {{
                                            formatCurrency(
                                                product.pivot.quantity *
                                                    product.price
                                            )
                                        }}</span
                                    >
                                </li>
                            </ul>
                            <div>
                                <h6>Observações:</h6>
                                <div
                                    class="card shadow-sm bg-light p-3 overflow-auto"
                                    style="max-height: 150px; min-height: 150px"
                                >
                                    <p>{{ orderSlip.notes }}</p>
                                </div>
                            </div>
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <span class="fs-5 fw-bold">Total:</span>
                                <span class="fs-5 fw-bold">{{
                                    formatCurrency(orderSlip.total_price)
                                }}</span>
                            </div>
                            <div class="d-flex gap-3">
                                <Link
                                    :href="
                                        route('order-slips.edit', orderSlip.id)
                                    "
                                    class="w-100 btn bg-dark inline-flex rounded-1 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                                >
                                    Adicionar Produto
                                </Link>
                                <PrimaryButton
                                    class="w-100"
                                    @click="openDeleteModal(orderSlip)"
                                >
                                    Encerar Comanda
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ConfirmModal
                :isVisible="isModalVisible"
                title="Confirmar Exclusão de Comanda"
                message="Você tem certeza que deseja excluir esta comanda? Esta ação não pode ser desfeita."
                @confirm="confirmDelete"
                @cancel="cancelDelete"
            />
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.overflow-auto {
    overflow-y: auto;
}
</style>
