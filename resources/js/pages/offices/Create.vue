<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { FormControl, FormField, FormItem, FormLabel } from '@/components/ui/form';
import AppLayout from '@/layouts/AppLayout.vue';
import { officesIndex, officesStore } from '@/routes/offices';
import { Head, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Building2, Mail, Phone, User, Plus } from 'lucide-vue-next';
import Input from '@/components/ui/input/Input.vue';

const form = useForm({
    name: '',
    head: '',
    phone: '',
    email: '',
});

const submit = () => {
    form.post(officesStore.url(), {
        forceFormData: true,
        onSuccess: () => {
            alert('Office registered successfully!');
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Create Office" />

    <AppLayout>
        <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-blue-50 to-white py-16 px-6 sm:px-10 lg:px-16">
            <!-- Header -->
            <div class="mb-10 flex flex-col items-center justify-between gap-4 sm:flex-row">
                <div class="text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-indigo-700 flex items-center gap-2">
                        <Building2 class="h-8 w-8 text-indigo-600" /> Register a New Office
                    </h1>
                    <p class="mt-2 text-indigo-500 max-w-xl">
                        Add a new department or office under the Local Government Unit of Sta. Maria, Bulacan.
                    </p>
                </div>

                <Button
                    as="a"
                    :href="officesIndex().url"
                    class="flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 font-semibold text-gray-700 shadow-sm transition hover:bg-gray-300"
                >
                    <ArrowLeft class="h-4 w-4" />
                    Back to Offices
                </Button>
            </div>

            <!-- Card -->
            <div class="mx-auto w-full max-w-2xl rounded-2xl border border-indigo-100 bg-white p-10 shadow-xl transition hover:shadow-2xl duration-200">
                <form @submit.prevent="submit" class="space-y-8">
                    <!-- Office Name -->
                    <FormField name="office_name">
                        <FormItem>
                            <FormLabel for="name" class="text-gray-700 font-semibold">Office Name</FormLabel>
                            <FormControl>
                                <div class="relative">
                                    <Input
                                        v-model="form.name"
                                        id="name"
                                        type="text"
                                        required
                                        class="mt-2 w-full rounded-xl border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="e.g. Municipal Health Office"
                                    />
                                    <Building2 class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" />
                                </div>
                            </FormControl>
                            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                        </FormItem>
                    </FormField>

                    <!-- Department Head -->
                    <!-- <FormField name="department_director">
                        <FormItem>
                            <FormLabel for="head" class="text-gray-700 font-semibold">Department Head</FormLabel>
                            <FormControl>
                                <div class="relative">
                                    <Input
                                        v-model="form.head"
                                        id="head"
                                        type="text"
                                        required
                                        class="mt-2 w-full rounded-xl border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="e.g. Dr. Juan Dela Cruz"
                                    />
                                    <User class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" />
                                </div>
                            </FormControl>
                            <p v-if="form.errors.head" class="mt-1 text-sm text-red-600">{{ form.errors.head }}</p>
                        </FormItem>
                    </FormField> -->

                    <!-- Contact Number -->
                    <FormField name="phone">
                        <FormItem>
                            <FormLabel for="phone" class="text-gray-700 font-semibold">Contact Number</FormLabel>
                            <FormControl>
                                <div class="relative">
                                    <Input
                                        v-model="form.phone"
                                        id="phone"
                                        type="tel"
                                        required
                                        class="mt-2 w-full rounded-xl border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="e.g. (044) 123-4567"
                                    />
                                    <Phone class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" />
                                </div>
                            </FormControl>
                            <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                        </FormItem>
                    </FormField>

                    <!-- Email -->
                    <FormField name="email">
                        <FormItem>
                            <FormLabel for="email" class="text-gray-700 font-semibold">Email Address</FormLabel>
                            <FormControl>
                                <div class="relative">
                                    <Input
                                        v-model="form.email"
                                        id="email"
                                        type="email"
                                        required
                                        class="mt-2 w-full rounded-xl border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="e.g. healthoffice@stamaria.gov.ph"
                                    />
                                    <Mail class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" />
                                </div>
                            </FormControl>
                            <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                        </FormItem>
                    </FormField>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <Button
                            type="button"
                            as="a"
                            href="/offices"
                            class="rounded-lg bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200 transition"
                        >
                            Cancel
                        </Button>
                        <Button
                            type="submit"
                            class="flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-6 py-2.5 font-semibold text-white shadow-md transition hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 disabled:opacity-70"
                            :disabled="form.processing"
                        >
                            <Plus class="h-4 w-4" />
                            Create Office
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
input {
    transition: all 0.2s ease-in-out;
}
input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgb(99 102 241 / 25%);
}
</style>
