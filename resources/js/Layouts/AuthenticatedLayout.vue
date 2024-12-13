<script setup>
import { Link } from "@inertiajs/vue3";
import { Menu, ArrowRightFromLine, X } from "lucide-vue-next";
</script>

<template>
    <div
        class="offcanvas offcanvas-start"
        data-bs-scroll="true"
        tabindex="-1"
        id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel"
    >
        <div class="offcanvas-header d-flex justify-content-between">
            <div>
                <span class="fw-bold fs-4">Comandify</span>
            </div>
            <button type="button" data-bs-dismiss="offcanvas">
                <X />
            </button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <ul class="list-unstyled mb-auto">
                <li>
                    <Link
                        :href="route('dashboard')"
                        data-bs-dismiss="offcanvas"
                        class="btn btn-dark w-100 mb-2"
                        >Dashboard</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('dashboard')"
                        data-bs-dismiss="offcanvas"
                        class="btn btn-dark w-100 mb-2"
                        >Products</Link
                    >
                </li>
            </ul>

            <ul class="list-unstyled mt-auto">
                <li>
                    <Link
                        :href="route('dashboard')"
                        data-bs-dismiss="offcanvas"
                        class="btn btn-dark w-100 mb-2"
                        >How to use</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('dashboard')"
                        data-bs-dismiss="offcanvas"
                        class="btn btn-dark w-100 mb-2"
                        >Settings</Link
                    >
                </li>
            </ul>
        </div>
    </div>

    <div>
        <header
            class="bg-dark p-3 shadow d-flex justify-content-between align-items-center"
        >
            <div class="d-flex align-items-center gap-3">
                <button
                    class="btn btn-dark border text-white d-flex align-items-center"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions"
                    aria-controls="offcanvasWithBothOptions"
                >
                    <Menu class="me-2" /> Menu
                </button>
                <div>
                    <span class="fw-bold fs-4 text-white">Comandify</span>
                </div>
            </div>
            <Link
                :href="route('logout')"
                method="post"
                class="btn btn-dark border text-white d-flex align-items-center"
                ><ArrowRightFromLine class="me-2" /> Log Out
            </Link>
        </header>

        <main class="container-fluid py-3 bg-light">
            <slot />
        </main>
    </div>
</template>

<style scoped>
.offcanvas-body {
    padding-top: 1rem;
}
</style>
