<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="d-flex min-vh-100 flex-column justify-content-center align-items-center bg-light py-4"
    >
        <div
            class="w-100 border overflow-hidden bg-white p-4 mx-auto"
            style="max-width: 500px;"
        >
            <Link href="/" class="text-decoration-none text-dark">
                <span class="fw-bold fs-1">Comandify</span>
            </Link>

            <div class="w-100 overflow-hidden mt-4">
                <slot />
            </div>
        </div>
    </div>
</template>
