<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <div class="d-flex flex-column min-vh-100">
        <header class="bg-dark text-white py-3 shadow">
            <div
                class="container d-flex justify-content-between align-items-center"
            >
                <Link href="/" class="text-decoration-none">
                    <span class="fw-bold fs-4 text-white">Comandify</span>
                </Link>
                <nav>
                    <div class="d-flex gap-3">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('order-slip.index')"
                            class="text-white text-decoration-none"
                        >
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="text-white text-decoration-none"
                            >
                                Log in
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="text-white text-decoration-none"
                            >
                                Register
                            </Link>
                        </template>
                    </div>
                </nav>
            </div>
        </header>
        <main class="flex-grow-1 bg-light py-5">
            <div class="container text-center">
                <h1 class="mb-4 text-dark">Welcome to Laravel + Vue 3</h1>
                <p class="lead text-muted">
                    This is a sample application with Laravel, Vue 3, and
                    Bootstrap 5.
                </p>
            </div>
        </main>
        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p class="mb-0">© 2024 Comandify. All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>

<style scoped></style>
