<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    MousePointerSquareDashed,
    SidebarCloseIcon,
    ClipboardCheck,
} from "lucide-vue-next";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import { toRefs, onMounted } from "vue";

const props = defineProps({
    orderSlips: Array,
    flash: Object,
});

const { flash } = toRefs(props);

onMounted(() => {
    if (flash.value?.success) {
        toast.success(flash.value.success, {
            theme: "dark",
            position: "bottom-center",
            transition: "flip",
        });
    }
});
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
                    <div class="card border">
                        <div class="card-header bg-dark text-white d-flex justify-content-between">
                            <h5 class="mb-0">Comanda #{{ orderSlip.order_number }}</h5>
                            <h5 class="mb-0">Mesa #{{ orderSlip.table_number }}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="text-muted">{{ orderSlip.customer_name }}</h6>
                            <ul class="list-group list-group-flush mb-3 overflow-auto" style="max-height: 200px; min-height: 200px;">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                    v-for="(product, index) in orderSlip.products"
                                    :key="index"
                                >
                                    <span>{{ product.pivot.quantity }} - {{ product.name }}</span>
                                    <span class="fw-bold">R$ {{ product.price }}</span>
                                </li>
                            </ul>
                            <div class="mb-3">
                                <h6>Observações:</h6>
                                <div class="border rounded p-2 bg-light overflow-auto" style="max-height: 150px; min-height: 150px;">
                                    <p class="mb-0">{{ orderSlip.notes }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Total:</h6>
                                <span class="fw-bold">R$ {{ orderSlip.total_price }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <PrimaryButton class="btn btn-primary w-100">
                                    <MousePointerSquareDashed />
                                    Adicionar Produto
                                </PrimaryButton>
                                <PrimaryButton class="btn btn-primary w-100">
                                    <SidebarCloseIcon />
                                    Finalizar Comanda
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.overflow-auto {
    overflow-y: auto;
}
</style>
