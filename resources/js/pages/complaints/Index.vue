<script setup lang="ts">
import DataTable from '@/components/complaints/DataTable.vue';
import { columns } from '@/components/complaints/column';
import AppLayout from '@/layouts/AppLayout.vue';
import { complaintsCreate, complaintsIndex } from '@/routes/complaints';
import type { Complaint } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Complaints',
        href: complaintsIndex().url,
    },
];

const props = defineProps<{ complaints: Complaint[] }>();

const { props: inertiaProps } = usePage();
const user = computed(() => inertiaProps.auth?.user);
const role = computed(() => user.value?.role ?? 'guest');

const tableData = computed(() => props.complaints ?? []);
</script>

<template>
    <Head title="Complaints" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="mx-auto my-10 max-w-5xl rounded-3xl border border-indigo-100 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-6 sm:p-10 shadow-xl"
        >
            <!-- Header -->
            <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1
                        class="text-3xl font-extrabold tracking-tight text-indigo-700 drop-shadow-sm"
                    >
                        My Complaints
                    </h1>
                    <p class="mt-1 max-w-xl text-sm text-indigo-500">
                        Track and manage all the complaints you’ve submitted to monitor progress and resolutions.
                    </p>
                </div>

                <Link
                    :href="complaintsCreate().url"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-6 py-2.5 font-semibold text-white shadow-md transition-all hover:scale-[1.03] hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
                >
                    + Submit Complaint
                </Link>
            </div>

            <!-- Complaints Table -->
            <div
                v-if="tableData.length"
                class="overflow-x-auto rounded-xl border border-indigo-100 bg-white p-4 sm:p-6 shadow-inner"
            >
                <DataTable
                    :columns="columns"
                    :data="tableData"
                    :role="role"
                    title="Complaint Records"
                    caption="List of all submitted complaints and their current status"
                />
            </div>

            <!-- Empty State -->
            <div
                v-else
                class="rounded-2xl border border-indigo-200 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 py-16 text-center shadow-inner"
            >
                <h2 class="mb-3 text-2xl font-semibold text-indigo-700">
                    No Complaints Yet
                </h2>
                <p class="mb-6 text-sm text-indigo-500">
                    Once you submit a complaint, it will appear here for tracking and resolution updates.
                </p>

                <Link
                    :href="complaintsCreate().url"
                    class="inline-block rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-6 py-2.5 font-semibold text-white shadow-md transition-all hover:scale-[1.03] hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
                >
                    Submit Your First Complaint
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
tr {
    transition: background-color 0.2s ease-in-out;
}
</style>
