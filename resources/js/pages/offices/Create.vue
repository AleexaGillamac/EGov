<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Form, useForm, router, usePage } from '@inertiajs/vue3';
import { create, store } from '@/routes/offices';
import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';
import { handleError } from 'vue';



const breadcrumbs: BreadcrumbItem[] = [
     {
          title: 'Offices',
          href: create().url,
     },
];

const form = useForm({
     name: '',
     description: '',
});


</script>

<template>

     <Head title="Dashboard" />

     <AppLayout :breadcrumbs="breadcrumbs">
          <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
               <h1>Create Offices</h1>
               <Form  :action="store()" 
               method="POST" 
               
               disable-while-processing
               class="w-8/12 space-y-3.5">
                    <div class="space-y-2">
                         <Label for="OfficesName">Name:</Label>
                         <Input v-model="form.name" type="text" name="name"></Input>
                         <div class="test-sm text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>
                    <div class="space-y-2">
                         <Label for="OfficesName">Description</Label>
                         <Input v-model="form.description" type="text" name="description" class="h-10" required></Input>
                         <div class="test-sm text-red-600" v-if="form.errors.description">{{ form.errors.description }}
                         </div>
                    </div>
                    <Button type="submit" >Add Office</Button>
               </Form>
          </div>

     </AppLayout>
</template>
