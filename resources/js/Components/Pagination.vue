<script setup>
const props = defineProps({
    currentPage: Number,
    lastPage: Number,
});

const emit = defineEmits(["page-change"]);

const changePage = (page) => {
    if (page >= 1 && page <= props.lastPage && page !== props.currentPage) {
        emit("page-change", page);
    }
};
</script>

<template>
    <nav class="mt-3">
        <ul class="pagination">
            <li class="page-item" :class="{ disable: props.currentPage === 1 }">
                <button
                    class="page-link text-black"
                    @click="changePage(props.currentPage - 1)"
                    :disabled="props.currentPage === 1"
                >
                    Anterior
                </button>
            </li>

            <li
                class="page-item"
                v-for="page in Array.from(
                    { length: props.lastPage },
                    (_, i) => i + 1
                )"
                :key="page"
                :class="{ active: page === props.currentPage }"
            >
                <button
                    class="page-link text-black"
                    :class="{
                        active: page === props.currentPage,
                        'bg-dark': page === props.currentPage,
                        'text-white': page === props.currentPage,
                        'border-dark': page === props.currentPage
                    }"
                    @click="changePage(page)"
                >
                    {{ page }}
                </button>
            </li>

            <li
                class="page-item"
                :class="{ disable: props.currentPage === props.lastPage }"
            >
                <button
                    class="page-link text-black"
                    @click="changePage(props.currentPage + 1)"
                    :disabled="props.currentPage === props.lastPage"
                >
                    Próximo
                </button>
            </li>
        </ul>
    </nav>
</template>
