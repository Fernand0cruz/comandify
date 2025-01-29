<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    orderSlip: Object,
    products: Array,
    flash: Object,
});

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

    form.put(route("order-slips.update", props.orderSlip.id));

    props.products.forEach((product) => {
        product.inputQuantity = null;
    });
};

const adjustQuantity = (product) => {
    if (product.inputQuantity > product.quantity) {
        product.inputQuantity = product.quantity;
    }
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
            <div class="d-flex justify-content-between mb-3">
                <h2>Comanda #{{ orderSlip.order_number }}</h2>
            </div>

            <div class="card shadow-sm p-4">
                <div class="d-flex flex-column gap-4">
                    <span class="fs-5 fw-bold"
                        >Cliente: {{ orderSlip.customer_name }}</span
                    >
                    <span class="fs-5 fw-bold"> Produtos: </span>
                </div>
                <div v-if="orderSlip.products.length === 0">
                    <span class="text-center"> Nenhum produto encontrado </span>
                </div>
                <ul class="list-group list-group-flush">
                    <li
                        v-for="(product, index) in orderSlip.products"
                        :key="index"
                        class="py-1 border-bottom d-flex justify-content-between"
                    >
                        <span
                            >{{ product.pivot.quantity }} x {{ product.name }} -
                            {{ formatCurrency(product.price) }}</span
                        >
                        <span class="fw-bold">
                            {{
                                formatCurrency(
                                    product.pivot.quantity * product.price
                                )
                            }}</span
                        >
                    </li>
                </ul>
                <div
                    class="d-flex justify-content-between align-items-center mt-4"
                >
                    <span class="fs-5 fw-bold">Total:</span>
                    <span class="fs-5 fw-bold">{{
                        formatCurrency(orderSlip.total_price)
                    }}</span>
                </div>
            </div>

            <div class="mt-3 card shadow-sm">
                <div class="card-body">
                    <span class="fs-5 fw-bold"> Adicionar produto(s) </span>
                    <div class="my-3">
                        <TextInput
                            id="name"
                            type="text"
                            class="form-control"
                            v-model="searchQuery"
                            placeholder="Buscar produto..."
                        />
                    </div>
                    <div
                        class="table-responsive"
                        style="max-height: 450px; min-height: 450px"
                    >
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Disponível</th>
                                    <th>Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(product, index) in filteredProducts"
                                    :key="index"
                                >
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.quantity }}</td>
                                    <td>{{ formatCurrency(product.price) }}</td>
                                    <td>
                                        <span
                                            class="badge py-2 px-4 rounded-5"
                                            :class="
                                                product.quantity > 0
                                                    ? 'bg-success'
                                                    : 'bg-danger'
                                            "
                                        >
                                            {{
                                                product.quantity > 0
                                                    ? "Sim"
                                                    : "Nao"
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <input
                                            type="number"
                                            class="form-control"
                                            :max="product.quantity"
                                            @input="adjustQuantity(product)"
                                            v-model.number="
                                                product.inputQuantity
                                                "
                                            placeholder="'Qtd'"
                                            min="1"
                                        />
                                    </td>
                                </tr>
                                <tr v-if="filteredProducts.length === 0">
                                    <td colspan="4" class="text-center">
                                        Nenhum produto encontrado
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <PrimaryButton class="mt-3" @click="addProductsToOrderSlip">
                        Adicionar Selecionados
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
