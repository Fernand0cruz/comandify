<script setup>
import { ref } from "vue";
import { Bar } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
} from "chart.js";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
);

const props = defineProps({
    orderSlips: Array,
});

const orders = ref(props.orderSlips);

const getComandasAndSales = (orders, period) => {
    const now = new Date();
    const periodData = {
        day: {
            start: new Date(now.getFullYear(), now.getMonth(), now.getDate()),
            end: new Date(
                now.getFullYear(),
                now.getMonth(),
                now.getDate(),
                23,
                59,
                59
            ),
        },
        week: {
            start: new Date(now.setDate(now.getDate() - now.getDay())),
            end: new Date(now.setDate(now.getDate() + 6)),
        },
        month: {
            start: new Date(now.getFullYear(), now.getMonth(), 1),
            end: new Date(now.getFullYear(), now.getMonth() + 1, 0),
        },
        year: {
            start: new Date(now.getFullYear(), 0, 1),
            end: new Date(now.getFullYear(), 11, 31),
        },
    };

    const { start, end } = periodData[period];

    return orders.filter((order) => {
        const orderDate = new Date(order.created_at);
        return orderDate >= start && orderDate <= end;
    });
};

const totalSalesByPeriod = (orders) => {
    return orders
        .reduce((total, order) => total + parseFloat(order.total_price), 0)
        .toFixed(2);
};

const getTopSellingProducts = (orders) => {
    const productSales = {};

    orders.forEach((order) => {
        order.products.forEach((product) => {
            const productId = product.id;
            if (!productSales[productId]) {
                productSales[productId] = {
                    name: product.name,
                    totalSold: 0,
                    totalRevenue: 0,
                };
            }
            productSales[productId].totalSold += product.pivot.quantity;
            productSales[productId].totalRevenue +=
                product.pivot.quantity * parseFloat(product.price);
        });
    });

    const sortedProducts = Object.values(productSales).sort(
        (a, b) => b.totalSold - a.totalSold
    );

    return sortedProducts.slice(0, 5);
};

const ordersByDay = getComandasAndSales(orders.value, "day");
const ordersByWeek = getComandasAndSales(orders.value, "week");
const ordersByMonth = getComandasAndSales(orders.value, "month");
const ordersByYear = getComandasAndSales(orders.value, "year");

const totalComandasDay = ordersByDay.length;
const totalSalesDay = totalSalesByPeriod(ordersByDay);

const totalComandasWeek = ordersByWeek.length;
const totalSalesWeek = totalSalesByPeriod(ordersByWeek);

const totalComandasMonth = ordersByMonth.length;
const totalSalesMonth = totalSalesByPeriod(ordersByMonth);

const totalComandasYear = ordersByYear.length;
const totalSalesYear = totalSalesByPeriod(ordersByYear);

const topSellingProducts = getTopSellingProducts(orders.value);

function formatCurrency(value) {
    return new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
    }).format(value);
}

const comandasData = {
    labels: ["Dia", "Semana", "Mês", "Ano"],
    datasets: [
        {
            label: "Comandas",
            data: [
                totalComandasDay,
                totalComandasWeek,
                totalComandasMonth,
                totalComandasYear,
            ],
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
        },
    ],
};

const salesData = {
    labels: ["Dia", "Semana", "Mês", "Ano"],
    datasets: [
        {
            label: "Vendas",
            data: [
                totalSalesDay,
                totalSalesWeek,
                totalSalesMonth,
                totalSalesYear,
            ],
            backgroundColor: "rgba(153, 102, 255, 0.2)",
            borderColor: "rgba(153, 102, 255, 1)",
            borderWidth: 1,
        },
    ],
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="container">
            <div>
                <h2>Relatório</h2>
                <p class="text-danger">
                    É recomendado apagar os dados uma vez por ano (final do
                    ano). Você pode fazer isso
                    <Link
                        :href="route('settings')"
                        class="text-danger font-bold underline"
                    >
                        clicando aqui </Link
                    >.
                </p>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Comandas no Dia</h5>
                        <p class="card-text">{{ totalComandasDay }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Comandas na Semana</h5>
                        <p class="card-text">{{ totalComandasWeek }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Comandas no Mês</h5>
                        <p class="card-text">{{ totalComandasMonth }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Comandas no Ano</h5>
                        <p class="card-text">{{ totalComandasYear }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Vendas no Dia</h5>
                        <p class="card-text">
                            {{ formatCurrency(totalSalesDay) }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Vendas na Semana</h5>
                        <p class="card-text">
                            {{ formatCurrency(totalSalesWeek) }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Vendas no Mês</h5>
                        <p class="card-text">
                            {{ formatCurrency(totalSalesMonth) }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Vendas no Ano</h5>
                        <p class="card-text">
                            {{ formatCurrency(totalSalesYear) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Comandas por Período</h5>
                        <Bar :data="comandasData" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm p-3">
                        <h5 class="card-title">Vendas por Período</h5>
                        <Bar :data="salesData" />
                    </div>
                </div>
            </div>

            <div class="mt-3 card shadow-sm p-3">
                <h4>Produtos Mais Vendidos</h4>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade Vendida</th>
                                <th>Total de Vendas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="product in topSellingProducts"
                                :key="product.name"
                            >
                                <td class="text-nowrap">{{ product.name }}</td>
                                <td class="text-nowrap">{{ product.totalSold }}</td>
                                <td class="text-nowrap">
                                    {{ formatCurrency(product.totalRevenue) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
