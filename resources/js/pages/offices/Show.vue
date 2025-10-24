<script setup lang="ts">
    import { Office } from '@/types';
    import { useForm } from 'vee-validate';

    defineProps<{
        offices: {
            id: number;
            name: string;
            code: string;
            description: string;
            email: string;
            phone: string;
        }[];
    }>();

    useForm<Office>({
        name: '',
        code: '',
        description: '',
        email: '',
        
    });
</script>

<template>
    <form @submit.prevent="submit" class="space-y-5">
        <!-- Office Name -->
        <div>
            <label class="block font-medium">Subject</label>
            <input v-model="form.subject" type="text" class="w-full rounded border p-2" required />
            <div v-if="form.errors.subject" class="text-sm text-red-500">
                {{ form.errors.subject }}
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block font-medium">Description</label>
            <textarea v-model="form.description" class="h-28 w-full rounded border p-2" required></textarea>
            <div v-if="form.errors.description" class="text-sm text-red-500">
                {{ form.errors.description }}
            </div>
        </div>

        <!-- Category Dropdown -->
        <div>
            <label class="block font-medium">Category</label>
            <select v-model="form.category_id" class="w-full rounded border p-2" required>
                <option value="">Select a category</option>
                <option v-for="cat in props.categories" :key="cat.id" :value="cat.id">
                    {{ cat.name }}
                </option>
            </select>
            <div v-if="form.errors.category_id" class="text-sm text-red-500">
                {{ form.errors.category_id }}
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            :disabled="form.processing">
            {{ form.processing ? 'Submitting...' : 'Submit Complaint' }}
        </button>
    </form>
</template>
