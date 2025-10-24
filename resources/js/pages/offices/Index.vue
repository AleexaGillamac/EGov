<script setup lang="ts">
import { columns } from '@/components/offices/column';
import DataTable from '@/components/offices/DataTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { officesIndex, officesCreate, officesEdit } from '@/routes/offices';
import type { Office } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { computed } from 'vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Offices',
    href: officesIndex().url,
  },
];

const props = defineProps<{ offices: Office[] }>();

const { props: inertiaProps } = usePage();
const user = computed(() => inertiaProps.auth?.user);
const role = computed(() => user.value?.role ?? 'guest');

const tableData = computed(() => props.offices ?? []);
</script>

<template>
  <Head title="Offices" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="mx-auto my-6 w-full max-w-6xl rounded-3xl border border-indigo-100 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-5 sm:p-8 md:p-10 shadow-xl"
    >
      <!-- Header Section -->
      <div
        class="mb-8 flex flex-col gap-4 sm:gap-6 md:flex-row md:items-center md:justify-between"
      >
        <div class="text-center md:text-left">
          <h1
            class="text-2xl sm:text-3xl font-extrabold tracking-tight text-indigo-700 drop-shadow-sm"
          >
            Offices of Sta. Maria, Bulacan
          </h1>
          <p
            class="mt-2 max-w-xl mx-auto md:mx-0 text-sm sm:text-base text-indigo-500"
          >
            Directory of local government offices under the LGU of Sta. Maria.
            View contact information or coordinate for public service concerns.
          </p>
        </div>

        <div class="flex justify-center md:justify-end">
          <Link
            v-if="['admin', 'superadmin'].includes(role)"
            :href="officesCreate().url"
            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-4 sm:px-6 py-2 sm:py-2.5 font-semibold text-sm sm:text-base text-white shadow-md transition-all hover:scale-[1.03] hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
          >
            <Plus class="mr-2 h-4 w-4 sm:h-5 sm:w-5" />
            Create Office
          </Link>
        </div>
      </div>

      <!-- Table Section -->
      <div
        v-if="tableData.length"
        class="overflow-x-auto rounded-xl border border-indigo-100 bg-white p-4 sm:p-6 shadow-inner"
      >
        <DataTable
          :columns="columns"
          :data="tableData"
          :role="role"
          title="Offices of Sta. Maria, Bulacan"
          caption="Directory of government offices"
          :create-url="
            offices.length ? officesEdit({ office: offices[0].id }).url : undefined
          "
        />
      </div>

      <!-- Empty State -->
      <div
        v-else
        class="rounded-2xl border border-indigo-200 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 py-12 sm:py-16 text-center shadow-inner"
      >
        <h2
          class="mb-3 text-xl sm:text-2xl font-semibold text-indigo-700"
        >
          No Offices Found
        </h2>
        <p class="mb-6 text-sm sm:text-base text-indigo-500">
          Once offices are registered, they’ll appear here for easy access.
        </p>

        <Link
          v-if="['admin', 'superadmin'].includes(role)"
          :href="officesCreate().url"
          class="inline-block rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-5 sm:px-6 py-2.5 font-semibold text-sm sm:text-base text-white shadow-md transition-all hover:scale-[1.03] hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 hover:shadow-lg focus:ring-2 focus:ring-indigo-300 focus:outline-none"
        >
          Create First Office
        </Link>
      </div>

      <!-- Footer -->
      <p
        class="mt-8 text-center text-xs sm:text-sm text-indigo-500 leading-relaxed"
      >
        For corrections or updates, please contact the
        <span class="font-semibold text-indigo-700">
          Municipal Information Office
        </span>.
      </p>
    </div>
  </AppLayout>
</template>

<style scoped>
tr {
  transition: background-color 0.2s ease-in-out;
}
</style>
