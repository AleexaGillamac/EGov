<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3'
import { create } from '@/routes/offices'
import Button from '@/components/ui/button/Button.vue'
import type { ColumnDef } from '@tanstack/vue-table'
import DataTable from '@/components/offices/DataTable.vue'
import { edit, destroy } from '@/routes/offices'
import { h } from 'vue'
const props = defineProps<{ offices: { id: number; name: string }[] }>()


// Define your table columns
const columns: ColumnDef<{ id: number; name: string }>[] = [
     {
          accessorKey: 'id',
          header: 'ID',
          cell: info => info.getValue(),
     },
     {
          accessorKey: 'name',
          header: 'Name',
          cell: info => info.getValue(),
     },

     {
          accessorKey: 'Action',
          header: 'Action',
          cell: ({ row }) => {
               const offices = row.original
               return h('div', { class: 'flex gap-2' }, [
                    h(Button, {
                         class: '',
                         // onclick: () => router.visit(`/offices/${offices.id}/edit`)
                    }),
                    h(Button, {
                         class: '',
                         // onclick: () => router.delete('/offices/${offices.id}')
                    })
               ])
          }
     }
]
</script>

<template>

     <Head title="Offices" />

     <AppLayout>
          <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
               <!-- Page Title -->
               <div>
                    <h1 class="text-3xl font-semibold text-gray-800">Offices</h1>
                    <p class="text-gray-500 mt-1">Manage all office departments here</p>
               </div>

               <!-- Create Office Button -->
               <Link :href="create()">
               <Button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Create Office
               </Button>
               </Link>
          </div>
          <div class="bg-white shadow rounded-md p-4">
               <DataTable :data="props.offices" :columns="columns" />
          </div>
     </AppLayout>
</template>
