<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputError from "@/Components/InputError.vue";
import NumberInput from "@/Components/NumberInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import CurrencyInput from "@/Components/CurrencyInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    categories: Array,
});

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

const form = useForm({
    name: "",
    description: "",
    price: "",
    category_id: "",
    quantity: 1,
});

const submit = () => {
    form.post(route("products.store"), {
        onSuccess: () => {
            form.reset();
        },
        onError: (erro) => {
            console.error(erro);
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <h2 class="mb-3">Criar Produto</h2>
            <div class="border p-4">
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
                        <InputLabel for="price" value="Preço" />
                        <CurrencyInput
                            id="price"
                            class="form-control"
                            v-model="form.price"
                            required
                        />
                        <InputError
                            class="mt-2 text-danger"
                            :message="form.errors.price"
                        />
                    </div>

                    <div class="mb-3">
                        <InputLabel for="quantity" value="Quantidade" />
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
                        <InputLabel for="category" value="Categoria" />
                        <select
                            id="category"
                            class="form-select rounded-0"
                            v-model="form.category_id"
                            required
                        >
                            <option disabled value="">
                                Selecione a categoria
                            </option>
                            <option
                                v-for="category in categories"
                                :key="category"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <InputError
                            class="mt-2 text-danger"
                            :message="form.errors.category"
                        />
                    </div>

                    <div class="mb-3">
                        <InputLabel for="description" value="Descrição" />
                        <TextAreaInput
                            id="description"
                            class="form-control"
                            v-model="form.description"
                            rows="10"
                            required
                        />
                        <InputError
                            class="mt-2 text-danger"
                            :message="form.errors.description"
                        />
                    </div>

                    <div class="mt-4">
                        <PrimaryButton type="submit">
                            Criar Produto
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
select:focus {
    border-color: #343a40 !important;
    outline: none !important;
    box-shadow: none !important;
}
</style>
