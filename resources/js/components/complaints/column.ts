import { h } from 'vue'
import type { Complaint } from '@/types'
import type { ColumnDef } from '@tanstack/vue-table'

export const columns: ColumnDef<Complaint>[] = [
  {
    accessorKey: 'subject',
    header: () => h('div', { class: 'font-bold' }, 'Subject'),
    cell: ({ row }) => h('div', row.getValue('subject')),
  },
  {
    accessorKey: 'office.name',
    header: () => h('div', { class: 'font-bold' }, 'Office'),
    cell: ({ row }) => h('div', row.original.office?.name ?? '—'),
  },
  {
    accessorKey: 'category.name',
    header: () => h('div', { class: 'font-bold' }, 'Category'),
    cell: ({ row }) => h('div', row.original.category?.name ?? '—'),
  },
  {
    accessorKey: 'status',
    header: () => h('div', { class: 'font-bold' }, 'Status'),
    cell: ({ row }) => {
      const status = row.getValue('status') as string
      const color =
        status === 'Resolved'
          ? 'text-green-600'
          : status === 'Pending'
          ? 'text-yellow-600'
          : 'text-gray-600'
      return h('span', { class: color }, status)
    },
  },
  {
    accessorKey: 'created_at',
    header: () => h('div', { class: 'font-bold' }, 'Date Submitted'),
    cell: ({ row }) => {
      const date = new Date(row.getValue('created_at'))
      return h('div', date.toLocaleDateString())
    },
  },
]
