<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {
    Trash,
    MousePointerSquareDashed,
    SidebarCloseIcon,
    ClipboardCheck,
} from "lucide-vue-next";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>
    <AuthenticatedLayout>
        <section>
            <div class="mb-3">
                <h2 class="text-2xl font-semibold">Comandas</h2>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Comandas abertas: 15</span>
                    <PrimaryButton class="d-flex align-items-center gap-3">
                        <ClipboardCheck />
                        Criar Comanda
                    </PrimaryButton>
                </div>
            </div>
            <div class="card-container">
                <div class="card" v-for="i in 15" :key="i">
                    <div class="p-3 bg-dark text-white">
                        <div class="d-flex justify-content-between">
                            <span>Comanda #{{ i }}</span>
                            <span>Mesa #{{ i + 5 }}</span>
                        </div>
                        <span>Luiz Fernando</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group rounded-0 scrollable-list">
                            <li
                                class="d-flex justify-content-between align-items-center mb-1 border"
                                v-for="i in 15"
                                :key="i"
                            >
                                <div class="p-2">
                                    <span> 5x - Coca-Cola </span>
                                </div>
                                <div>
                                    <span> R$ 20,00 </span>
                                    <DangerButton>
                                        <trash />
                                    </DangerButton>
                                </div>
                            </li>
                        </ul>
                        <div class="border my-3 observacoes">
                            <h5>Observações</h5>
                            <div class="scrollable-observacoes">
                                <p>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Blanditiis est nulla,
                                    nesciunt fuga magnam veritatis dicta
                                    deleniti ut quis sit aperiam omnis ipsum
                                    mollitia perspiciatis voluptas repudiandae
                                    fugiat minus accusantium! Another
                                    observation to test the scroll effect. Lorem
                                    ipsum dolor sit amet consectetur adipisicing
                                    elit. Blanditiis est nulla, nesciunt fuga
                                    magnam veritatis dicta deleniti ut quis sit
                                    aperiam omnis ipsum mollitia perspiciatis
                                    voluptas repudiandae fugiat minus
                                    accusantium! Even more text to make sure the
                                    scroll works! Lorem ipsum dolor sit amet
                                    consectetur adipisicing elit. Blanditiis est
                                    nulla, nesciunt fuga magnam veritatis dicta
                                    deleniti ut quis sit aperiam omnis ipsum
                                    mollitia perspiciatis voluptas repudiandae
                                    fugiat minus accusantium!
                                </p>
                            </div>
                        </div>
                        <div
                            class="d-flex justify-content-between border mb-3 p-3"
                        >
                            <span>Total</span>
                            <span>R$ 100,00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <PrimaryButton
                                class="d-flex align-items-center gap-3"
                            >
                                <MousePointerSquareDashed />
                                Adicionar Produto
                            </PrimaryButton>
                            <PrimaryButton
                                class="d-flex align-items-center gap-3"
                            >
                                <SidebarCloseIcon />
                                Finalizar Comanda
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>
.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(419px, 1fr));
    gap: 1rem;
    justify-items: center;
}

.card-container > .card:nth-last-child(-n + 4) {
    justify-self: start;
}

.scrollable-list {
    max-height: 275px;
    overflow-y: auto;
    min-height: 275px;
}

.observacoes {
    min-height: 150px;
    padding-left: 1rem;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.scrollable-observacoes {
    max-height: 150px; /* Ajuste conforme necessário */
    overflow-y: auto;
    padding-right: 1rem; /* Adicione um espaço para a barra de rolagem */
}
</style>
