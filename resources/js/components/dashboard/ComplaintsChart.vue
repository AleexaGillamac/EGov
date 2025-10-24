<script setup lang="ts">
import {
    BarElement,
    CategoryScale,
    Chart as ChartJS,
    Legend,
    LinearScale,
    Title,
    Tooltip,
} from 'chart.js';
import { Bar } from 'vue-chartjs';

// Register Chart.js components
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const props = defineProps<{
    labels: string[];
    data: number[];
}>();

const chartData = {
    labels: props.labels,
    datasets: [
        {
            label: 'Complaints',
            backgroundColor: '#6366f1',
            borderRadius: 8,
            data: props.data,
        },
    ],
};

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: true, position: 'bottom' },
    },
};
</script>

<template>
    <div class="h-64">
        <Bar
            :data="chartData"
            :options="chartOptions"
        />
    </div>
</template>
