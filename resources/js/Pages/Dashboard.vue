<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatCard from '@/Components/StatCard.vue';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

defineProps({
    agency: Object,
    mode: String,
    stats: Object,
    projects: Array,
});
</script>

<template>
    <section class="space-y-8">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-teal-700">White-label dental agency</p>
            <h1 class="mt-2 text-3xl font-bold">{{ agency.agency_name }} Dashboard</h1>
            <p class="mt-2 text-slate-600">Manage Canadian dental website, SEO, GBP, and ads projects under your own brand.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-4">
            <StatCard v-for="(value, key) in stats" :key="key" :title="key.replaceAll('_', ' ')" :value="value" />
        </div>

        <div class="card">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">Recent projects</h2>
                <Link v-if="mode === 'internal'" href="/clients" class="btn-primary">View clients</Link>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b text-slate-500">
                            <th class="py-3">Project</th>
                            <th class="py-3">Client</th>
                            <th class="py-3">Type</th>
                            <th class="py-3">Status</th>
                            <th class="py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="project in projects" :key="project.id" class="border-b last:border-0">
                            <td class="py-3 font-semibold">{{ project.name }}</td>
                            <td class="py-3">{{ project.client?.clinic_name || 'Your clinic' }}</td>
                            <td class="py-3 capitalize">{{ project.type }}</td>
                            <td class="py-3 capitalize">{{ project.status.replaceAll('_', ' ') }}</td>
                            <td class="py-3 text-right"><Link :href="`/projects/${project.id}`" class="text-teal-700 font-semibold">Open</Link></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>
