<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

const form = useForm({
    clinic_name: '',
    contact_name: '',
    contact_email: '',
    contact_phone: '',
    website_url: '',
    city: '',
    province: '',
    address: '',
    services: [],
    status: 'lead',
});

function submit() {
    form.post('/clients');
}
</script>

<template>
    <section class="mx-auto max-w-3xl">
        <h1 class="text-3xl font-bold">Add dental client</h1>
        <form class="card mt-6 space-y-4" @submit.prevent="submit">
            <div>
                <label class="label">Clinic name</label>
                <input v-model="form.clinic_name" class="input" required />
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="label">Contact name</label>
                    <input v-model="form.contact_name" class="input" />
                </div>
                <div>
                    <label class="label">Contact email</label>
                    <input v-model="form.contact_email" type="email" class="input" />
                </div>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="label">Website URL</label>
                    <input v-model="form.website_url" type="url" class="input" />
                </div>
                <div>
                    <label class="label">Phone</label>
                    <input v-model="form.contact_phone" class="input" />
                </div>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="label">City</label>
                    <input v-model="form.city" class="input" />
                </div>
                <div>
                    <label class="label">Province</label>
                    <input v-model="form.province" class="input" />
                </div>
            </div>
            <div>
                <label class="label">Status</label>
                <select v-model="form.status" class="input">
                    <option value="lead">Lead</option>
                    <option value="active">Active</option>
                    <option value="paused">Paused</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <button class="btn-primary" :disabled="form.processing">Create client</button>
        </form>
    </section>
</template>
