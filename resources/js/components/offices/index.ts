import { h } from 'vue'
import type { ColumnDef } from '@tanstack/vue-table'
import type { Offices } from '@/types/offices.d.ts'

export const columns: ColumnDef<Offices>[] = [
     {
          id: 'name', 
          header: () => h('div', { class: 'font-bold' }, 'Name'),
          cell: ({ row }) => h('div', {}, row.getValue('name')),
     },
     {
          id: 'description',
          header: () => h('div', { class: 'font-bold' }, 'Description'),
          cell: ({ row }) => h('div', {}, row.getValue('description')),
     },
     {
          id: 'actions',
          header: () => h('div', { class: 'text-center font-bold' }, 'Actions'),
          cell: ({ row }) =>
               h(
                    'button',
                    {
                         class: 'px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600',
                         onClick: () => alert(`Edit office: ${row.original.name}`),
                    },
                    'Edit'
               ),
     },
]
