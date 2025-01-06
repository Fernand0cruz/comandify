<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    orderSlip: Object,
    products: Array,
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <span>Comanda #{{ props.orderSlip.order_number }} </span>
                <span> Mesa #{{ props.orderSlip.table_number }} </span>
                <span>{{ props.orderSlip.customer_name }}</span>
            </div>
            <div class="border p-4">
                <div>
                    <ul>
                        <li>products</li>
                    </ul>
                </div>
                <div>
                    {{ props.products }}
                </div>
                <div>
                    <PrimaryButton @click="openDeleteModal(orderSlip)">
                        Adicionar produto
                    </PrimaryButton>
                    <PrimaryButton @click="openDeleteModal(orderSlip)">
                        Finalizar Comanda
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
