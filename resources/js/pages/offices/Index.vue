<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage} from '@inertiajs/vue3';
import { index, create } from '@/routes/offices';
import Button from '@/components/ui/button/Button.vue';
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'; 

const breadcrumbs: BreadcrumbItem[] = [
     {
          title: 'Offices',
          href: index().url,
     },
];

const page = usePage();

interface DataTableProps<TData, TValue> {
     columns: ColumnDef<TData, TValue>[]
     data: TData[]
}

export function DataTable<TData, TValue>({
     columns,
     data,
}: DataTableProps<TData, TValue>) {
     const table = useReactTable({
          data,
          columns,
          getCoreRowModel: getCoreRowModel(),
     })
</script>

<template>

     <Head title="Dashboard" />

     <AppLayout :breadcrumbs="breadcrumbs">
          <Alert variant="default">
               <Terminal />
               <AlertTitle>Success!</AlertTitle>
               <AlertDescription>
                    <div v-if="$page.props.flash?.message" class="alert">
                         {{ $page.props.flash.message }}
                    </div>
               </AlertDescription>
          </Alert>
          <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
               <Link :href="create()"><Button>Create Offices</Button></Link>
          </div>
     </AppLayout>
</template>
