<script setup>
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ClipboardCheck } from "lucide-vue-next";

const products = ref([ ]);

const selectedCategory = ref(null);

const filteredProducts = computed(() => {
    if (!selectedCategory.value) {
        return products.value;
    }
    return products.value.filter(
        (product) => product.category === selectedCategory.value
    );
});

const filterByCategory = (category) => {
    selectedCategory.value =
        selectedCategory.value === category ? null : category;
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Lista de Produtos</h2>
            </div>
            <div class="mb-3 d-md-flex justify-content-between align-items-center">
                <div v-show="products.length > 0">
                    <span class="me-2 fw-bold">Filtrar por Categoria:</span>
                    <button
                        v-for="category in [
                            ...new Set(products.map((p) => p.category)),
                        ]"
                        :key="category"
                        class="btn btn-sm me-2"
                        :class="{
                            'btn-primary': selectedCategory === category,
                            'btn-outline-primary':
                                selectedCategory !== category,
                        }"
                        @click="filterByCategory(category)"
                    >
                        {{ category }}
                    </button>
                    <button
                        class="btn btn-sm btn-outline-secondary"
                        @click="selectedCategory = null"
                    >
                        Limpar Filtro
                    </button>
                </div>
                <PrimaryButton class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                    <ClipboardCheck />
                    Criar Produto
                </PrimaryButton>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th>Quantidade</th>
                            <th>Disponível</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(product, index) in filteredProducts"
                            :key="product.id"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ product.name }}</td>
                            <td>
                                <div
                                    class="text-truncate"
                                    style="max-width: 250px"
                                    :title="product.description"
                                >
                                    {{ product.description }}
                                </div>
                            </td>
                            <td>R$ {{ product.price.toFixed(2) }}</td>
                            <td>
                                <span
                                    class="text-primary text-decoration-underline cursor-pointer"
                                    @click="filterByCategory(product.category)"
                                >
                                    {{ product.category }}
                                </span>
                            </td>
                            <td>{{ product.quantity }}</td>
                            <td class="text-center">
                                <span
                                    class="badge py-2 px-4 rounded-5"
                                    :class="
                                        product.isAvailable
                                            ? 'bg-success'
                                            : 'bg-danger'
                                    "
                                >
                                    {{ product.isAvailable ? "Sim" : "Não" }}
                                </span>
                            </td>
                            <td class="text-center">
                                <PrimaryButton
                                    class="btn btn-sm btn-primary"
                                    @click="editProduct(product.id)"
                                >
                                    Editar
                                </PrimaryButton>
                            </td>
                        </tr>
                        <tr v-if="filteredProducts.length === 0">
                            <td colspan="8" class="text-center text-muted p-3">
                                Nenhum produto disponível.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
