<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    invoices: Object
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div class="mb-3">
                <h2>Notas</h2>
            </div>
            <div class="card shadow-sm p-4">
                <div v-for="(invoice, index) in props.invoices" :key="index">
                    <ul>
                        <li>{{  invoice.customer_name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
