<script setup lang="ts" generic="TData, TValue">
import Button from '@/components/ui/button/Button.vue'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { valueUpdater } from '@/lib/utils'
import {
  FlexRender,
  getCoreRowModel,
  getPaginationRowModel,
  getSortedRowModel,
  useVueTable,
  type ColumnDef,
  type SortingState,
} from '@tanstack/vue-table'
import {
  Edit3,
  FolderOpen,
  FileText,
  ArrowLeftCircle,
  ArrowRightCircle,
} from 'lucide-vue-next'
import { ref } from 'vue'

const props = defineProps<{
  columns: ColumnDef<TData, TValue>[]
  data: TData[]
  role?: string
  title?: string
  caption?: string
}>()

const sorting = ref<SortingState>([])

const table = useVueTable({
  get data() {
    return props.data
  },
  get columns() {
    return props.columns
  },
  getCoreRowModel: getCoreRowModel(),
  getPaginationRowModel: getPaginationRowModel(),
  getSortedRowModel: getSortedRowModel(),
  onSortingChange: (updaterOrValue) => valueUpdater(updaterOrValue, sorting),
  state: {
    get sorting() {
      return sorting.value
    },
  },
})
</script>

<template>
  <div
    class="w-full overflow-hidden rounded-2xl border border-indigo-100 bg-white shadow-md"
  >
    <!-- Header -->
    <div
      class="flex flex-col items-center justify-between gap-3 bg-gradient-to-r from-indigo-50 via-blue-50 to-purple-50 px-4 py-5 md:flex-row md:px-6"
    >
      <div class="text-center md:text-left">
        <h1
          class="text-lg md:text-2xl font-bold text-indigo-700 flex items-center justify-center md:justify-start gap-2"
        >
          <FolderOpen class="h-5 w-5 md:h-6 md:w-6 text-indigo-600" />
          {{ props.title ?? 'Records Directory' }}
        </h1>
        <p class="mt-1 text-sm text-gray-600">
          {{ props.caption ?? 'List of all available records.' }}
        </p>
      </div>
    </div>

    <!-- Responsive Table Container -->
    <div class="w-full overflow-x-auto">
      <Table class="w-full border-collapse text-left min-w-[600px]">
        <TableHeader class="border-b border-indigo-100 bg-indigo-50/60">
          <template
            v-for="headerGroup in table.getHeaderGroups()"
            :key="headerGroup.id"
          >
            <TableRow>
              <TableHead
                v-for="header in headerGroup.headers"
                :key="header.id"
                class="px-2 md:px-4 py-2 md:py-3 font-semibold text-indigo-800 text-xs md:text-sm"
              >
                <FlexRender
                  v-if="!header.isPlaceholder"
                  :render="header.column.columnDef.header"
                  :props="header.getContext()"
                />
              </TableHead>
              <TableHead
                v-if="['admin', 'superadmin'].includes(props.role ?? '')"
                class="px-2 md:px-4 py-2 md:py-3 text-center font-semibold text-indigo-800 text-xs md:text-sm"
              >
                Actions
              </TableHead>
            </TableRow>
          </template>
        </TableHeader>

        <TableBody>
          <!-- Rows -->
          <template v-if="table.getRowModel().rows.length > 0">
            <TableRow
              v-for="row in table.getRowModel().rows"
              :key="row.id"
              class="border-b border-gray-100 transition hover:bg-indigo-50/50"
            >
              <TableCell
                v-for="cell in row.getVisibleCells()"
                :key="cell.id"
                class="px-2 md:px-4 py-2 md:py-3 text-gray-700 text-sm"
              >
                <FlexRender
                  :render="cell.column.columnDef.cell"
                  :props="cell.getContext()"
                />
              </TableCell>

              <TableCell
                v-if="['admin', 'superadmin'].includes(props.role ?? '')"
                class="px-2 md:px-4 py-2 md:py-3 text-center"
              >
                <Button
                  variant="ghost"
                  class="rounded-md px-2 md:px-3 py-1 text-xs md:text-sm text-indigo-700 hover:bg-indigo-100"
                  @click="$emit('edit', row.original)"
                >
                  <Edit3 class="h-4 w-4 inline-block mr-1" />
                  Edit
                </Button>
              </TableCell>
            </TableRow>
          </template>

          <!-- Empty State -->
          <TableRow v-else>
            <TableCell
              :colspan="props.columns.length + (['admin', 'superadmin'].includes(props.role ?? '') ? 1 : 0)"
              class="py-10 text-center text-gray-500"
            >
              <div class="flex flex-col items-center justify-center space-y-2">
                <FileText class="h-8 w-8 text-indigo-400" />
                <p class="font-medium">No records found.</p>
                <p class="text-xs md:text-sm">Add data to see it appear here.</p>
              </div>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>

    <!-- Pagination -->
    <div
      class="flex flex-col md:flex-row items-center justify-between gap-3 px-4 md:px-6 py-4 bg-gray-50 border-t border-indigo-100"
    >
      <span class="text-xs md:text-sm text-gray-600 text-center md:text-left">
        Showing page {{ table.getState().pagination.pageIndex + 1 }}
      </span>

      <div class="flex items-center justify-center space-x-2">
        <Button
          variant="outline"
          size="sm"
          class="flex items-center gap-1 text-gray-700 hover:text-indigo-700 text-xs md:text-sm"
          :disabled="!table.getCanPreviousPage()"
          @click="table.previousPage()"
        >
          <ArrowLeftCircle class="h-4 w-4" />
          Previous
        </Button>
        <Button
          variant="outline"
          size="sm"
          class="flex items-center gap-1 text-gray-700 hover:text-indigo-700 text-xs md:text-sm"
          :disabled="!table.getCanNextPage()"
          @click="table.nextPage()"
        >
          Next
          <ArrowRightCircle class="h-4 w-4" />
        </Button>
      </div>
    </div>
  </div>
</template>

<style scoped>
tr {
  transition: background-color 0.2s ease-in-out;
}
</style>
