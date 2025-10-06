// resources/js/pages/offices/components/columns.ts
import { h } from 'vue'
import type { ColumnDef } from '@tanstack/vue-table'
// import DropdownAction from '@/components/DataTableDropDown.vue'

// Define Office interface (must match your Laravel Office model fields)
export default {
    props: {
     offices: Object
    }
}

export const columns: ColumnDef<Office>[] = [
     {
          accessorKey: 'id',
          header: () => h('div', { class: 'text-left font-medium' }, 'ID'),
     },
     {
          accessorKey: 'name',
          header: () => h('div', { class: 'text-left font-medium' }, 'Name'),
          cell: ({ row }) => h('div', { class: 'font-semibold' }, row.getValue('name')),
     },
     {
          accessorKey: 'description',
          header: () => h('div', { class: 'text-left font-bold' }, 'Description'),
          cell: ({ row }) => {
               const description = row.getValue('Description')   // ❌ Wrong key, capital D
               return h('div', {}, row.getValue('description') as string)
          },
     },
     {
          id: 'actions',
          enableHiding: false,
          cell: ({ row }) => {
               const office = row.original
               return h('div', { class: 'relative' }, h(DropdownAction, { office }))
          },
     },
]
