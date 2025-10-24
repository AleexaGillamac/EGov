<script setup lang="ts">
import offices, { update } from '@/routes/offices';
import { OfficeForm} from '@/types';
import { useForm } from '@inertiajs/vue3';

defineProps<{
    offices: {
        id: number
        name: string;
        code: string;
        description: string;
        email: string;
        phone: string;
    }[];
}>();

const form = useForm<OfficeForm>({
    name: '',
    code: '',
    description: '',
    email: '',
    phone: '',
});

const submit = () => {
    form.post(update(), {
        forceFormData: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <form
        @submit.prevent="submit"
        class="space-y-5"
    >
        <!-- Office Name -->
        <div>
            <label class="block font-medium">Subject</label>
            <input
                v-model="form.name"
                type="text"
                class="w-full rounded border p-2"
                required
            />
            <div
                v-if="form.errors.name"
                class="text-sm text-red-500"
            >
                {{ form.errors.name }}
            </div>
        </div>

        <!-- Office Code -->
        <div>
            <label class="block font-medium">Office Code</label>
            <input
                v-model="form.code"
                type="text"
                class="w-full rounded border p-2"
                required
            />
            <div
                v-if="form.errors.code"
                class="text-sm text-red-500"
            >
                {{ form.errors.code }}
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block font-medium">Description</label>
            <textarea
                v-model="form.description"
                class="h-28 w-full rounded border p-2"
                required
            ></textarea>
            <div
                v-if="form.errors.description"
                class="text-sm text-red-500"
            >
                {{ form.errors.description }}
            </div>
        </div>

        <!-- Director Dropdown List-->
        <!-- <div>
            <label class="block font-medium">Category</label>
            <select
                v-model="form.category_id"
                class="w-full rounded border p-2"
                required
            >
                <option value="">Select a category</option>
                <option
                    v-for="cat in props.categories"
                    :key="cat.id"
                    :value="cat.id"
                >
                    {{ cat.name }}
                </option>
            </select>
            <div
                v-if="form.errors.category_id"
                class="text-sm text-red-500"
            >
                {{ form.errors.category_id }}
            </div>
        </div> -->

        <!-- Email  -->
        <div>
            <label class="block font-medium">Email</label>
            <textarea
                v-model="form.email"
                class="h-28 w-full rounded border p-2"
                required
            ></textarea>
            <div
                v-if="form.errors.email"
                class="text-sm text-red-500"
            >
                {{ form.errors.email }}
            </div>
        </div>

        <!-- Phone -->
        <div>
            <label class="block font-medium">Phone</label>
            <input
                v-model="form.phone"
                type="text"
                class="w-full rounded border p-2"
                required
            />
            <div
                v-if="form.errors.phone"
                class="text-sm text-red-500"
            >
                {{ form.errors.phone }}
            </div>
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            :disabled="form.processing"
        >
            {{ form.processing ? 'Submitting...' : 'Submit Complaint' }}
        </button>
    </form>
</template>
