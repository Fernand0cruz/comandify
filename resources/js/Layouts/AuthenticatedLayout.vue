<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";
import { Menu, ArrowRightFromLine, X } from "lucide-vue-next";
</script>

<template>
    <div
        class="offcanvas offcanvas-start"
        data-bs-scroll="true"
        tabindex="-1"
        id="offcanvasScrolling"
        aria-labelledby="offcanvasScrolling"
    >
        <div class="offcanvas-header d-flex justify-content-between">
            <div>
                <span class="fw-bold fs-4">Comandify</span>
            </div>
            <button type="button" class="btn" data-bs-dismiss="offcanvas">
                <X />
            </button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <ul class="list-unstyled mb-auto">
                <li>
                    <a
                        :href="route('order-slip.index')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white w-100 mb-2"
                    >
                        Comandas
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white w-100 mb-2"
                    >
                        Produtos
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white w-100 mb-2"
                    >
                        Relatórios
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white w-100 mb-2"
                    >
                        Notas
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled mt-auto">
                <li>
                    <a
                        :href="route('product.index')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white w-100 mb-2"
                    >
                        Como usar
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="inline-flex btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white w-100 mb-2"
                    >
                        Configurações
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div>
        <header
            class="bg-dark p-3 shadow d-flex justify-content-between align-items-center"
        >
            <div class="d-flex align-items-center gap-3">
                <PrimaryButton
                    class="btn btn-dark border text-white d-flex align-items-center"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling"
                    aria-controls="offcanvasScrolling"
                >
                    <Menu class="me-2" /> Menu
                </PrimaryButton>
                <div>
                    <span class="fw-bold fs-4 text-white">Comandify</span>
                </div>
            </div>
            <Link
                :href="route('logout')"
                as="button"
                method="post"
                class="inline-flex border btn btn-dark rounded-0 items-center px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white"
            >
                <ArrowRightFromLine class="me-2" /> Sair
            </Link>
        </header>

        <main class="container-fluid py-5">
            <slot />
        </main>
    </div>
</template>
