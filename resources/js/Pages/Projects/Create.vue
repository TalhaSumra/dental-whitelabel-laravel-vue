<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

const props = defineProps({ client: Object, packages: Array });

const form = useForm({
    service_package_id: null,
    name: '',
    type: 'bundle',
    status: 'not_started',
    start_date: '',
    due_date: '',
    client_price_cad: 2500,
    white_label_cost_cad: 900,
    scope: '',
});

function usePackage(pkg) {
    form.service_package_id = pkg.id;
    form.name = pkg.name;
    form.type = pkg.type;
    form.client_price_cad = pkg.setup_price_cad;
}

function submit() {
    form.post(`/clients/${props.client.id}/projects`);
}
</script>

<template>
    <section class="mx-auto max-w-4xl space-y-6">
        <div>
            <p class="text-sm font-semibold uppercase text-teal-700">New project</p>
            <h1 class="text-3xl font-bold">{{ client.clinic_name }}</h1>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <button v-for="pkg in packages" :key="pkg.id" type="button" class="card text-left hover:border-teal-500" @click="usePackage(pkg)">
                <p class="font-bold">{{ pkg.name }}</p>
                <p class="mt-2 text-sm text-slate-500">Setup CAD ${{ pkg.setup_price_cad }} · Monthly CAD ${{ pkg.monthly_price_cad }}</p>
            </button>
        </div>

        <form class="card space-y-4" @submit.prevent="submit">
            <div>
                <label class="label">Project name</label>
                <input v-model="form.name" class="input" required />
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                <div>
                    <label class="label">Type</label>
                    <select v-model="form.type" class="input">
                        <option value="website">Website</option>
                        <option value="seo">SEO</option>
                        <option value="gbp">Google Business Profile</option>
                        <option value="ads">Google Ads</option>
                        <option value="content">Content</option>
                        <option value="bundle">Bundle</option>
                    </select>
                </div>
                <div>
                    <label class="label">Client price CAD</label>
                    <input v-model="form.client_price_cad" type="number" min="0" class="input" />
                </div>
                <div>
                    <label class="label">White-label cost CAD</label>
                    <input v-model="form.white_label_cost_cad" type="number" min="0" class="input" />
                </div>
            </div>
            <div>
                <label class="label">Scope</label>
                <textarea v-model="form.scope" rows="5" class="input" placeholder="Website pages, SEO deliverables, GBP work, reporting terms..."></textarea>
            </div>
            <button class="btn-primary" :disabled="form.processing">Create project</button>
        </form>
    </section>
</template>
