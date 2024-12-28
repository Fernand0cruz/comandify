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

const form = useForm({});

onMounted(() => {
    products.value = props.products.data;

    if (flash.value?.message) {
        toast.success(flash.value.message, {
            theme: "dark",
            position: "bottom-center",
            transition: "flip",
        });
    }
});

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

const openDeleteModal = (product) => {
    productToDelete.value = product;
    isModalVisible.value = true;
};

const confirmDelete = () => {
    if (productToDelete.value) {
        form.delete(route("product.destroy", productToDelete.value.id), {
            onSuccess: () => {
                form.get(route("product.index"));
                productToDelete.value = null;
                toast.success(flash.value?.message, {
                    theme: "dark",
                    position: "bottom-center",
                    transition: "flip",
                });
            },
            onError: (erro) => {
                console.error(erro);
            },
        });
    }
    isModalVisible.value = false;
};

const cancelDelete = () => {
    productToDelete.value = null;
    isModalVisible.value = false;
};

const handlePageChange = (page) => {
    console.log("Dados atualizados:", props.products);

    currentPage.value = page;
    form.get(route("product.index", { page }), {
        onSuccess: ({ props }) => {
            console.log("Dados atualizados:", props.products);
            products.value = props.products.data;
            lastPage.value = props.products.last_page;
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Produtos</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span
                        >Produtos cadastrados:
                        {{ translatedProducts.length }}</span
                    >
                    <Link
                        :href="route('product.create')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                    >
                        <ClipboardCheck />
                        Criar Produto
                    </Link>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
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
                        <tr
                            v-for="product in translatedProducts"
                            :key="product.id"
                        >
                            <td>#{{ product.id }}</td>
                            <td>{{ product.name }}</td>
                            <td>
                                <div
                                    class="text-truncate"
                                    style="max-width: 350px"
                                    :title="product.description"
                                >
                                    {{ product.description }}
                                </div>
                            </td>
                            <td>R$ {{ product.price }}</td>
                            <td>
                                <span>
                                    {{ product.category.name }}
                                </span>
                            </td>
                            <td>{{ product.quantity }}</td>
                            <td class="text-center">
                                <span
                                    class="badge py-2 px-4 rounded-5"
                                    :class="
                                        product.is_available
                                            ? 'bg-success'
                                            : 'bg-danger'
                                    "
                                >
                                    {{ product.is_available ? "Sim" : "Nao" }}
                                </span>
                            </td>
                            <td
                                class="text-center d-flex justify-content-center gap-3"
                            >
                                <Link
                                    class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
                                    :href="route('product.edit', product.id)"
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
                @cancel="cancelDelete"
            />
        </div>
    </AuthenticatedLayout>
</template>
