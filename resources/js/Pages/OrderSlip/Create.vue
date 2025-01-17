<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NumberInput from "@/Components/NumberInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import { toRefs, watch } from "vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    flash: Object,
});

const { flash } = toRefs(props);

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

watch(() => flash.value, (value) => {
    if (flash.value?.error) {
        showToast(flash.value.error, "error");
        value.error = null;
    }
});

const form = useForm({
    customer_name: "",
    table_number: "",
    notes: "",
});

const submit = () => {
    form.post(route("order-slip.store"), {
        onSuccess: () => {
            // form.reset();
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
            <h2 class="mb-3">Criar Comanda</h2>
            <div class="card shadow-sm p-4">
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <InputLabel for="name" value="Nome do cliente" />
                        <TextInput
                            id="name"
                            type="text"
                            class="form-control"
                            v-model="form.customer_name"
                            required
                            autofocus
                        />
                        <InputError
                            class="mt-2 text-danger"
                            :message="form.errors.customer_name"
                        />
                    </div>
                    <div class="mb-3">
                        <InputLabel for="table" value="Mesa" />
                        <NumberInput
                            id="table"
                            type="number"
                            class="form-control"
                            v-model="form.table_number"
                            required
                        />
                        <InputError
                            class="mt-2 text-danger"
                            :message="form.errors.table_number"
                        />
                    </div>

                    <div class="mb-3">
                        <InputLabel for="notes" value="Observações" />
                        <TextAreaInput
                            id="notes"
                            class="form-control"
                            v-model="form.notes"
                            rows="10"
                        />
                    </div>

                    <div class="mt-4">
                        <PrimaryButton type="submit">
                            Criar Comanda
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
