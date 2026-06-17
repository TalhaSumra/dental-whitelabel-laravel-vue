<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

const props = defineProps({ agency: Object });

const form = useForm({
    agency_name: props.agency.agency_name || '',
    support_email: props.agency.support_email || '',
    support_phone: props.agency.support_phone || '',
    website_url: props.agency.website_url || '',
    brand_color: props.agency.brand_color || '#0f766e',
    client_report_footer: props.agency.client_report_footer || '',
});

function submit() {
    form.patch('/settings/agency');
}
</script>

<template>
    <section class="mx-auto max-w-3xl">
        <h1 class="text-3xl font-bold">Agency white-label settings</h1>
        <form class="card mt-6 space-y-4" @submit.prevent="submit">
            <div>
                <label class="label">Agency name</label>
                <input v-model="form.agency_name" class="input" required />
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="label">Support email</label>
                    <input v-model="form.support_email" type="email" class="input" />
                </div>
                <div>
                    <label class="label">Support phone</label>
                    <input v-model="form.support_phone" class="input" />
                </div>
            </div>
            <div>
                <label class="label">Website URL</label>
                <input v-model="form.website_url" type="url" class="input" />
            </div>
            <div>
                <label class="label">Brand color</label>
                <input v-model="form.brand_color" class="input" />
            </div>
            <div>
                <label class="label">Report footer</label>
                <textarea v-model="form.client_report_footer" rows="4" class="input"></textarea>
            </div>
            <button class="btn-primary">Save settings</button>
        </form>
    </section>
</template>
