import { h } from 'vue'
import type { Office } from '@/types'
import { ArrowUpDown, ChevronDown } from 'lucide-vue-next'
import type { ColumnDef } from '@tanstack/vue-table'
import { Button } from '@/components/ui/button'


export const columns: ColumnDef<Office>[] = [

     {
          accessorKey: 'name',
          header: ({ column }) => {
               return h(Button, {
                    variant: 'ghost',
                    class: 'font-bold',
                    onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
               },
                    () => ['Office Name', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
          },

          cell: ({ row }) => h('div', { class: 'uppercase' }, row.getValue('name')),

     },
     // {
     //      accessorKey: 'head',
     //      header: () => h('div', { class: 'font-bold' }, 'Office Head'),
     //      cell: ({ row }) => h('div', row.getValue('head')),
     // },
     {
          accessorKey: 'email',
          header: ({ column }) => {
               return h(Button, {
                    variant: 'ghost',
                    class: 'font-bold',
                    onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
               },
                    () => ['Email', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
          },
          cell: ({ row }) => h('div', row.getValue('email')),
     },
     {
          accessorKey: 'phone',
           header: ({ column }) => {
               return h(Button, {
                    variant: 'ghost',
                    class: 'font-bold',
                    onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
               },
                    () => ['Phone', h(ArrowUpDown, { class: 'ml-2 h-4 w-4' })])
          },
          cell: ({ row }) => h('div', row.getValue('phone')),
     },
]