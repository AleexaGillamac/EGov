<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import DataTable from '@/components/offices/DataTable.vue'
import { columns } from '@/components/offices/columns'
import type { Office } from '@/components/offices/columns'

const page = usePage<{ offices: Office[] }>()
const offices = page.props.offices
</script>

<template>
     <DataTable :data="offices" :columns="columns" />
</template>
