<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="d-flex flex-column min-vh-100">
        <!-- Header Section -->
        <header class="bg-dark text-white py-3 shadow">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="fw-bold fs-4">
                    <Link :href="route('home')">Comandify</Link>
                </div>
                <nav>
                    <div class="d-flex gap-3">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-white text-decoration-none">
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link :href="route('login')" class="text-white text-decoration-none">
                                Log in
                            </Link>
                            <Link v-if="canRegister" :href="route('register')" class="text-white text-decoration-none">
                                Register
                            </Link>
                        </template>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="flex-grow-1 bg-light py-5">
            <div class="container text-center">
                <h1 class="mb-4 text-dark">Welcome to Laravel + Vue 3</h1>
                <p class="lead text-muted">This is a sample application with Laravel, Vue 3, and Bootstrap 5.</p>
                <div class="mt-5">
                    <p class="text-muted small">
                        Laravel version: <strong>{{ laravelVersion }}</strong> | PHP version: <strong>{{ phpVersion }}</strong>
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p class="mb-0">© 2024 Comandify. All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>

<style scoped>

</style>
