<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    orderSlip: Object,
    products: Array,
});

import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

const searchQuery = ref("");

const form = useForm({
    products: [],
});

const filteredProducts = computed(() =>
    props.products.filter((product) =>
        product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);

const addProductsToOrderSlip = () => {
    const productsToAdd = props.products.filter((product) => {
        return product.inputQuantity > 0 && product.inputQuantity;
    });

    const dataToSend = productsToAdd.map((product) => ({
        order_slip_id: props.orderSlip.id,
        product_id: product.id,
        quantity: product.inputQuantity,
    }));

    form.products = dataToSend;

    form.put(route("order-slip.update", props.orderSlip.id));

    props.products.forEach((product) => {
        product.inputQuantity = null;
    });
};

const adjustQuantity = (product) => {
    if (product.inputQuantity > product.quantity) {
        product.inputQuantity = product.quantity;
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="container">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Comanda #{{ orderSlip.order_number }}</h2>
                </div>
                <div class="border p-4 d-flex flex-column gap-5">
                    <div>
                        <div class="d-flex flex-column gap-4">
                            <span class="fs-5 fw-bold">Cliente: {{ orderSlip.customer_name }}</span>
                            <span class="fs-5 fw-bold"> Produtos </span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li
                                v-for="(product, index) in orderSlip.products"
                                :key="index"
                                class="py-1 border-bottom d-flex justify-content-between"
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
                        <div v-if="orderSlip.products.length === 0">
                            <span class="text-center">
                                Nenhum produto encontrado
                            </span>
                        </div>
                    </div>

                    <div>
                        <span class="fs-5 fw-bold"> Adicionar produto(s) </span>
                        <div class="mb-3">
                            <TextInput
                                id="name"
                                type="text"
                                class="form-control"
                                v-model="searchQuery"
                                placeholder="Buscar produto..."
                            />
                        </div>
                        <div
                            class="table-responsive border"
                            style="max-height: 450px; min-height: 450px"
                        >
                            <table class="table table-borderless table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(
                                            product, index
                                        ) in filteredProducts"
                                        :key="index"

                                        :class="{
                                            'table-danger':
                                                product.quantity === 0
                                        }"
                                    >
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.quantity }}</td>
                                        <td>R$ {{ product.price }}</td>
                                        <td>
                                            <input
                                                type="number"
                                                class="form-control"
                                                min="1"
                                                :max="product.quantity"
                                                v-model.number="
                                                    product.inputQuantity
                                                "
                                                @input="adjustQuantity(product)"
                                                :placeholder="'Qtd'"
                                            />
                                        </td>
                                    </tr>
                                    <tr v-if="filteredProducts.length === 0">
                                        <td colspan="3" class="text-center">
                                            Nenhum produto encontrado
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <PrimaryButton
                            class="mt-3"
                            @click="addProductsToOrderSlip"
                        >
                            Adicionar Selecionados
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
