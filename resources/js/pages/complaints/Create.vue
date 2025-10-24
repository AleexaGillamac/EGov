<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';
import { FormControl, FormField, FormItem, FormLabel } from '@/components/ui/form';
import Input from '@/components/ui/input/Input.vue';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { complaintsStore } from '@/routes/complaints';
import type { ComplaintForm } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps<{
    categories: { id: number; label: string; office_id: number }[];
    offices: { id: number; name: string }[];
}>();

const form = useForm<ComplaintForm>({
    subject: '',
    description: '',
    category_id: null,
    office_id: null,
    anonymous: false,
    attachments: [],
});

const previewFiles = ref<File[]>([]);

const handleFiles = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const files = target.files ? Array.from(target.files) : [];
    form.attachments = [...files];
    previewFiles.value = [...files];
};

const removeFile = (index: number) => {
    previewFiles.value.splice(index, 1);
    form.attachments = [...previewFiles.value];
};

const filteredCategories = computed(() => {
    if (!form.office_id) return [];
    return props.categories.filter((cat) => Number(cat.office_id) === Number(form.office_id)) ?? [];
});

watch(
    () => form.office_id,
    () => {
        form.category_id = null;
    },
);

const submit = () => {
    form.post(complaintsStore.url(), {
        forceFormData: true,
        onSuccess: () => {
            alert('Complaint submitted succesfully!');
            form.reset();
            previewFiles.value = [];
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="mx-auto max-w-3xl rounded-2xl bg-white p-6 shadow">
            <h2 class="mb-6 text-2xl font-bold">Submit a Complaint</h2>

            <form
                @submit.prevent="submit"
                class="space-y-5"
                :class="{ 'pointer-events-none opacity-50': form.processing }"
            >
                <!-- Subject -->
                <FormField name="subject">
                    <FormItem>
                        <FormLabel class="block font-medium">Subject</FormLabel>
                        <FormControl>
                            <Input
                                v-model="form.subject"
                                type="text"
                                class="w-full rounded border p-2"
                                required
                            />
                        </FormControl>
                        <div
                            v-if="form.errors.subject"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.subject }}
                        </div>
                    </FormItem>
                </FormField>

                <!-- Description -->
                <FormField name="description">
                    <FormItem>
                        <FormLabel class="block font-medium">Description</FormLabel>
                        <Textarea
                            v-model="form.description"
                            class="h-28 w-full rounded border p-2"
                            required
                        ></Textarea>
                        <div
                            v-if="form.errors.description"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.description }}
                        </div>
                    </FormItem>
                </FormField>

                <!-- Office -->
                <FormField name="office">
                    <FormItem>
                        <FormLabel class="block font-medium">Office</FormLabel>
                        <Select
                            v-model.number="form.office_id"
                            class="w-full rounded border p-2"
                            required
                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Select an office" />
                            </SelectTrigger>

                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem
                                        v-for="office in props.offices"
                                        :key="office.id"
                                        :value="office.id"
                                    >
                                        {{ office.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <div
                            v-if="form.errors.office_id"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.office_id }}
                        </div>
                    </FormItem>
                </FormField>

                <!-- Category -->
                <FormField name="category">
                    <FormItem>
                        <FormLabel class="block font-medium">Category</FormLabel>
                        <Select
                            :key="form.office_id ?? ''"
                            v-model.number="form.category_id"
                            :disabled="!form.office_id || !filteredCategories.length"
                            required
                        >
                            <SelectTrigger>
                                <SelectValue placeholder="Select a category" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem
                                        v-for="cat in filteredCategories"
                                        :key="cat.id"
                                        :value="cat.id"
                                    >
                                        {{ cat.label }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>

                        <div
                            v-if="!filteredCategories.length && form.office_id"
                            class="mt-1 text-sm text-gray-500"
                        >
                            No categories available for this office.
                        </div>

                        <div
                            v-if="form.errors.category_id"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.category_id }}
                        </div>
                    </FormItem>
                </FormField>

                <!-- Anonymous -->
                <FormField name="anonymous">
                    <FormItem>
                        <div class="flex items-center space-x-2">
                            <Checkbox
                                type="checkbox"
                                id="anonymous"
                                v-model="form.anonymous"
                            />
                            <FormLabel
                                for="anonymous"
                                class="text-gray-700"
                                >Submit anonymously</FormLabel
                            >
                        </div>
                    </FormItem>
                </FormField>

                <!-- Attachments -->
                <FormField name="attachments">
                    <FormItem>
                        <FormLabel class="block font-medium">Attachments (optional)</FormLabel>
                        <Input
                            type="file"
                            multiple
                            @change="handleFiles"
                            class="block w-full"
                        />
                        <div
                            v-if="form.errors.attachments"
                            class="text-sm text-red-500"
                        >
                            {{ form.errors.attachments }}
                        </div>

                        <div
                            v-if="previewFiles.length"
                            class="mt-3 space-y-2"
                        >
                            <p class="text-sm font-semibold text-gray-700">Selected files:</p>
                            <ul class="space-y-1">
                                <li
                                    v-for="(file, index) in previewFiles"
                                    :key="index"
                                    class="flex items-center justify-between rounded border p-2 text-sm"
                                >
                                    <div>
                                        <span class="font-medium">{{ file.name }}</span>
                                        <span class="text-gray-500"
                                            >({{ (file.size / 1024).toFixed(1) }} KB)</span
                                        >
                                    </div>
                                    <Button
                                        type="button"
                                        class="text-red-500 hover:text-red-700"
                                        @click="removeFile(index)"
                                    >
                                        Remove
                                    </Button>
                                </li>
                            </ul>
                        </div>
                    </FormItem>
                </FormField>

                <!-- Submit -->
                <Button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Submitting...' : 'Submit Complaint' }}
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
