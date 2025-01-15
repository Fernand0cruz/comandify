<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";
import {
    Menu,
    ArrowRightFromLine,
    X,
    ListOrdered,
    PackageSearch,
    Book,
    Blinds,
    BadgeHelp,
    Settings,
} from "lucide-vue-next";
</script>

<template>
    <div
        class="offcanvas offcanvas-start"
        tabindex="-1"
        id="offcanvasScrolling"
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
            <ul class="list-unstyled">
                <li>
                    <a
                        :href="route('order-slip.index')"
                        class="btn btn-dark rounded-0 px-4 py-2 text-white text-start w-100 mb-2"
                    >
                        <ListOrdered class="me-2" />
                        Comandas
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="btn btn-dark rounded-0 px-4 py-2 text-white text-start w-100 mb-2"
                    >
                        <PackageSearch class="me-2" />
                        Produtos
                    </a>
                </li>
                <li>
                    <a
                        :href="route('reports')"
                        class="btn btn-dark rounded-0 px-4 py-2 text-white text-start w-100 mb-2"
                    >
                        <Book class="me-2" />
                        Relatório
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="btn btn-dark rounded-0 px-4 py-2 text-white text-start w-100 mb-2"
                    >
                        <Blinds class="me-2" />
                        Notas
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled mt-auto">
                <li>
                    <a
                        :href="route('product.index')"
                        class="btn btn-dark rounded-0 px-4 py-2 text-white text-start w-100 mb-2"
                    >
                        <BadgeHelp class="me-2" />
                        Como usar
                    </a>
                </li>
                <li>
                    <a
                        :href="route('product.index')"
                        class="btn btn-dark rounded-0 px-4 py-2 text-white text-start w-100 mb-2"
                    >
                        <Settings class="me-2" />
                        Configurações
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div>
        <header
            class="bg-dark p-3 d-flex justify-content-between align-items-center"
        >
            <div class="d-flex align-items-center gap-3">
                <PrimaryButton
                    class="btn btn-dark border text-white d-flex align-items-center"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling"
                >
                    <Menu class="me-2" />
                    Menu
                </PrimaryButton>
                <div>
                    <span class="fw-bold fs-4 text-white">Comandify</span>
                </div>
            </div>
            <Link
                :href="route('logout')"
                as="button"
                method="post"
                class="btn btn-dark border rounded-0 px-4 py-2 text-white"
            >
                <ArrowRightFromLine class="me-2" />
                Sair
            </Link>
        </header>

        <main class="container-fluid py-5">
            <slot />
        </main>
    </div>
</template>
