<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, toRefs, onMounted, computed } from "vue";
import { ClipboardCheck } from "lucide-vue-next";
import { Link, useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import DangerButton from "@/Components/DangerButton.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    products: Object,
    flash: Object,
});

const products = ref(props.products.data);
const { flash } = toRefs(props);
const isModalVisible = ref(false);
const productToDelete = ref(null);
const currentPage = ref(props.products.current_page);
const lastPage = ref(props.products.last_page);
const loading = ref(false);

const form = useForm({});

const categoryMapping = {
    Appetizer: "Entrada",
    Main_Course: "Prato Principal",
    Dessert: "Sobremesa",
    Beverage: "Bebida",
};

const translatedProducts = computed(() =>
    products.value.map((product) => ({
        ...product,
        category: {
            ...product.category,
            name:
                categoryMapping[product.category.name] || product.category.name,
        },
    }))
);

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

const openDeleteModal = (product) => {
    productToDelete.value = product;
    isModalVisible.value = true;
};

const closeDeleteModal = () => {
    productToDelete.value = null;
    isModalVisible.value = false;
};

const confirmDelete = () => {
    if (!productToDelete.value) return;
    form.delete(route("products.destroy", productToDelete.value.id), {
        onStart: () => (loading.value = true),
        onSuccess: () => {
            form.get(route("products.index"));
            showToast(flash.value?.success);
            closeDeleteModal();
        },
        onError: (erro) => {
            showToast("Ocorreu um erro. Por favor, tente novamente.", "error"),
                console.error(erro);
        },
        onFinish: () => (loading.value = false),
    });
};

const handlePageChange = (page) => {
    currentPage.value = page;
    form.get(route("products.index", { page }), {
        onStart: () => (loading.value = true),
        onSuccess: ({ props }) => {
            products.value = props.products.data;
            lastPage.value = props.products.last_page;
        },
        onError: (errors) => {
            console.error(errors);
        },
        onFinish: () => (loading.value = false),
    });
};

onMounted(() => {
    if (flash.value?.success) {
        showToast(flash.value.success);
        flash.value.success = null;
    }
});

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
                <h2>Produtos</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span
                        >Produtos cadastrados: {{ props.products.total }}</span
                    >
                    <Link
                        :href="route('products.create')"
                        class="inline-flex btn btn-dark rounded-1 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                    >
                        <ClipboardCheck />
                        Criar Produto
                    </Link>
                </div>
            </div>

            <div class="table-responsive card shadow-sm p-3">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#xxx</th>
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
                        <tr v-if="loading">
                            <td colspan="8" class="text-center text-muted py-4">
                                <div
                                    class="spinner-border text-dark"
                                    role="status"
                                >
                                    <span class="visually-hidden"
                                        >Carregando...</span
                                    >
                                </div>
                            </td>
                        </tr>
                        <tr
                            v-if="!loading"
                            v-for="(product, index) in translatedProducts"
                            :key="index"
                        >
                            <td>#{{ (currentPage - 1) * 25 + index + 1 }}</td>
                            <td class="text-nowrap">{{ product.name }}</td>
                            <td>
                                <div
                                    class="text-truncate"
                                    style="max-width: 350px"
                                    :title="product.description"
                                >
                                    {{ product.description }}
                                </div>
                            </td>
                            <td class="text-nowrap">
                                {{ formatCurrency(product.price) }}
                            </td>
                            <td class="text-nowrap">
                                <span>
                                    {{ product.category.name }}
                                </span>
                            </td>
                            <td>{{ product.quantity }}</td>
                            <td class="text-center">
                                <span
                                    class="badge py-2 px-4 rounded-5"
                                    :class="
                                        product.quantity > 0
                                            ? 'bg-success'
                                            : 'bg-danger'
                                    "
                                >
                                    {{ product.quantity > 0 ? "Sim" : "Nao" }}
                                </span>
                            </td>
                            <td>
                                <Link
                                    class="mx-3 inline-flex btn btn-dark rounded-1 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                                    :href="route('products.edit', product.id)"
                                >
                                    Editar
                                </Link>
                                <DangerButton @click="openDeleteModal(product)">
                                    Excluir
                                </DangerButton>
                            </td>
                        </tr>
                        <tr v-if="products.length === 0">
                            <td colspan="8" class="text-center text-muted p-3">
                                Nenhum produto disponível.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination
                v-if="products.length > 0"
                :currentPage="currentPage"
                :lastPage="lastPage"
                @page-change="handlePageChange"
            />

            <ConfirmModal
                :isVisible="isModalVisible"
                title="Confirmar Exclusão"
                message="Você tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita."
                @confirm="confirmDelete"
                @cancel="closeDeleteModal"
            />
        </div>
    </AuthenticatedLayout>
</template>
