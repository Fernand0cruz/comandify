<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ClipboardCheck, X } from "lucide-vue-next";
import { useForm } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import NumberInput from "@/Components/NumberInput.vue";
import { defineProps } from "vue";

const props = defineProps({
    categories: Array,
    products: Array,
});

const products = ref(props.products);

const categoryMapping = {
    Appetizer: "Entrada",
    Main_Course: "Prato Principal",
    Dessert: "Sobremesa",
    Beverage: "Bebida",
};

const categories = ref(
    props.categories.map((category) => ({
        ...category,
        name: categoryMapping[category.name] || category.name,
    }))
);

const translatedProducts = ref(
    products.value.map(product => ({
        ...product,
        category: {
            ...product.category,
            name: categoryMapping[product.category.name] || product.category.name,
        }
    }))
);

const form = useForm({
    name: "",
    description: "",
    price: "",
    category: "",
    quantity: 0,
});

const submit = () => {
    form.post("/produtos");
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Lista de Produtos</h2>
            </div>
            <div
                class="mb-3 d-md-flex justify-content-between align-items-center"
            >
                <PrimaryButton
                    class="d-flex align-items-center gap-3 mt-3 mt-md-0"
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"
                >
                    <ClipboardCheck />
                    Criar Produto
                </PrimaryButton>
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
                        <tr v-for="product in translatedProducts" :key="product.id">
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
                            <td class="text-center">
                                <PrimaryButton
                                    class="btn btn-sm btn-primary"
                                    @click="editProduct(product.id)"
                                >
                                    Editar
                                </PrimaryButton>
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

            <div
                class="modal fade"
                id="staticBackdrop"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabindex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div
                            class="modal-header d-flex justify-content-between"
                        >
                            <h5 class="modal-title" id="staticBackdropLabel">
                                Criar Produto
                            </h5>
                            <button
                                type="button"
                                class="btn"
                                data-bs-dismiss="modal"
                                aria-label="Fechar"
                            >
                                <X />
                            </button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submit">
                                <div class="mb-3">
                                    <InputLabel for="name" value="Nome" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        v-model="form.name"
                                        required
                                        autofocus
                                    />
                                    <InputError
                                        class="mt-2 text-danger"
                                        :message="form.errors.name"
                                    />
                                </div>
                                <div class="mb-3">
                                    <InputLabel
                                        for="description"
                                        value="Descrição"
                                    />
                                    <TextAreaInput
                                        id="description"
                                        class="form-control"
                                        v-model="form.description"
                                        rows="4"
                                        required
                                    />
                                    <InputError
                                        class="mt-2 text-danger"
                                        :message="form.errors.description"
                                    />
                                </div>
                                <div class="mb-3">
                                    <InputLabel for="price" value="Preço" />
                                    <TextInput
                                        id="price"
                                        class="form-control"
                                        v-model="form.price"
                                        v-mask="[
                                            'R$ #,##',
                                            'R$ ##,##',
                                            'R$ ###,##',
                                            'R$ #.###,##',
                                            'R$ ##.###,##',
                                        ]"
                                        required
                                    />
                                    <InputError
                                        class="mt-2 text-danger"
                                        :message="form.errors.price"
                                    />
                                </div>
                                <div class="mb-3">
                                    <InputLabel
                                        for="quantity"
                                        value="Quantidade"
                                    />
                                    <NumberInput
                                        id="quantity"
                                        type="number"
                                        class="form-control"
                                        v-model="form.quantity"
                                        required
                                    />
                                    <InputError
                                        class="mt-2 text-danger"
                                        :message="form.errors.quantity"
                                    />
                                </div>
                                <div class="mb-3">
                                    <InputLabel
                                        for="category"
                                        value="Categoria"
                                    />
                                    <select
                                        id="category"
                                        class="form-control rounded-0"
                                        v-model="form.category"
                                        required
                                    >
                                        <option disabled value="">
                                            Selecione a categoria
                                        </option>
                                        <option
                                            v-for="category in categories"
                                            :key="category"
                                            :value="category"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <InputError
                                        class="mt-2 text-danger"
                                        :message="form.errors.category"
                                    />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <DangerButton
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Fechar
                            </DangerButton>
                            <PrimaryButton type="submit">Criar</PrimaryButton>
                        </div>
                    </div>
                </div>
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

select:focus {
    border-color: #343a40 !important;
    outline: none !important;
    box-shadow: none !important;
}
</style>
