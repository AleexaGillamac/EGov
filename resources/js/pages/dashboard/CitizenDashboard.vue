<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { dashboard } from '@/routes'
import { type BreadcrumbItem } from '@/types'
import { Head, Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { BarChart3, AlertCircle, Clock, CheckCircle2, Plus } from 'lucide-vue-next'
import ComplaintsChart from '@/components/dashboard/ComplaintsChart.vue' // optional chart component

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
]

// Temporary sample stats — replace later with data from backend
const stats = computed(() => [
    {
        title: 'Total Complaints',
        value: 42,
        icon: AlertCircle,
        color: 'from-blue-500 to-indigo-500',
    },
    {
        title: 'Resolved',
        value: 28,
        icon: CheckCircle2,
        color: 'from-green-500 to-emerald-500',
    },
    {
        title: 'Pending',
        value: 14,
        icon: Clock,
        color: 'from-yellow-400 to-orange-500',
    },
])
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto my-10 max-w-6xl space-y-8 p-6">
            <!-- Header -->
            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-3xl font-extrabold text-indigo-700">Citizen Dashboard</h1>
                    <p class="text-sm text-indigo-500">
                        View your complaint statistics and monitor progress.
                    </p>
                </div>

                <Link
                    href="/complaints/create"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-6 py-2.5 font-semibold text-white shadow-md transition-all hover:scale-[1.03] hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
                >
                    <Plus class="mr-2 h-4 w-4" />
                    Submit New Complaint
                </Link>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="stat in stats"
                    :key="stat.title"
                    class="rounded-2xl border border-indigo-100 bg-gradient-to-br p-6 text-white shadow-lg"
                    :class="stat.color"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium opacity-90">{{ stat.title }}</p>
                            <h2 class="mt-1 text-3xl font-bold">{{ stat.value }}</h2>
                        </div>
                        <component :is="stat.icon" class="h-10 w-10 opacity-90" />
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div
                class="rounded-2xl border border-indigo-100 bg-white p-6 shadow-inner"
            >
                <h2 class="mb-4 text-lg font-semibold text-indigo-700">Complaints by Category</h2>
                <ComplaintsChart />
            </div>

            <!-- Recent Complaints Table -->
            <div
                class="rounded-2xl border border-indigo-100 bg-white p-6 shadow-inner"
            >
                <h2 class="mb-4 text-lg font-semibold text-indigo-700">Recent Complaints</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead>
                            <tr class="border-b text-indigo-600">
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Date Submitted</th>
                                <th class="px-4 py-2">Office</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="i in 3" :key="i" class="border-b hover:bg-indigo-50/40">
                                <td class="px-4 py-2">Road Repair</td>
                                <td class="px-4 py-2 text-yellow-600 font-semibold">Pending</td>
                                <td class="px-4 py-2">Oct 20, 2025</td>
                                <td class="px-4 py-2">Engineering Office</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
