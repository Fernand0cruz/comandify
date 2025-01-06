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

onMounted(() => {
    if (flash.value?.success) {
        toast.success(flash.value.success, {
            theme: "dark",
            position: "bottom-center",
            transition: "flip",
        });
        flash.value.success = null;
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
        form.delete(route("order-slip.destroy", orderSlipToDelete.value.id), {
            onSuccess: () => {
                form.get(route("order-slip.index"));
                orderSlipToDelete.value = null;
                toast.success(flash.value?.success, {
                    theme: "dark",
                    position: "bottom-center",
                    transition: "flip",
                });
                flash.value.success = null;
            },
            onError: (erro) => {
                console.error(erro);
            },
        });
    }
    isModalVisible.value = false;
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Comandas</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Comandas abertas: {{ props.orderSlips.length }}</span>
                    <Link
                        :href="route('order-slip.create')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                    >
                        <ClipboardCheck />
                        Criar Comanda
                    </Link>
                </div>
            </div>
            <div v-if="props.orderSlips.length === 0">
                Não há comandas abertas no momento.
            </div>
            <div v-else class="row g-4">
                <div
                    class="col-md-6 col-lg-4"
                    v-for="(orderSlip, index) in props.orderSlips"
                    :key="index"
                >
                    <div>
                        <div
                            class="p-2 border-dark bg-dark text-white d-flex justify-content-between"
                        >
                            <span class="fs-5 fw-bold">
                                Comanda #{{ orderSlip.order_number }}
                            </span>
                            <span class="fs-5 fw-bold">
                                Mesa #{{ orderSlip.table_number }}
                            </span>
                        </div>
                        <div class="border p-3">
                            <span class="fs-5 fw-bold">
                                {{ orderSlip.customer_name }}
                            </span>
                            <ul
                                class="overflow-auto list-unstyled"
                                style="max-height: 200px; min-height: 200px"
                            >
                                <li
                                    class="py-1 border-bottom d-flex justify-content-between"
                                    v-for="(
                                        product, index
                                    ) in orderSlip.products"
                                    :key="index"
                                >
                                    <span
                                        >{{ product.pivot.quantity }} x
                                        {{ product.name }} - R$
                                        {{ product.price }}</span
                                    >
                                    <span class="fw-bold"
                                        >R$
                                        {{
                                            (
                                                product.pivot.quantity *
                                                product.price
                                            ).toFixed(2)
                                        }}</span
                                    >
                                </li>
                            </ul>
                            <div class="mb-3">
                                <h6>Observações:</h6>
                                <div
                                    class="border p-2 bg-light overflow-auto"
                                    style="max-height: 150px; min-height: 150px"
                                >
                                    <p class="mb-0">{{ orderSlip.notes }}</p>
                                </div>
                            </div>
                            <div
                                class="d-flex justify-content-between align-items-center mb-3"
                            >
                                <span class="fs-5 fw-bold">Total:</span>
                                <span class="fs-5 fw-bold"
                                    >R$ {{ orderSlip.total_price }}</span
                                >
                            </div>
                            <div class="d-flex gap-3">
                                <Link
                                    :href="
                                        route('order-slip.edit', orderSlip.id)
                                    "
                                    class="w-100 btn bg-dark inline-flex rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                                >
                                    Adicionar Produto
                                </Link>
                                <PrimaryButton
                                    class="w-100"
                                    @click="openDeleteModal(orderSlip)"
                                >
                                    Finalizar Comanda
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
