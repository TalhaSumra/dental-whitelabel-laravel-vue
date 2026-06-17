<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

defineProps({ client: Object });
</script>

<template>
    <section class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase text-teal-700">Dental clinic</p>
                <h1 class="text-3xl font-bold">{{ client.clinic_name }}</h1>
                <p class="mt-1 text-slate-600">{{ client.city }}, {{ client.province }}</p>
            </div>
            <Link :href="`/clients/${client.id}/projects/create`" class="btn-primary">New project</Link>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="card">
                <p class="text-sm text-slate-500">Contact</p>
                <p class="mt-2 font-semibold">{{ client.contact_name || '-' }}</p>
                <p>{{ client.contact_email || '-' }}</p>
                <p>{{ client.contact_phone || '-' }}</p>
            </div>
            <div class="card md:col-span-2">
                <p class="text-sm text-slate-500">Website</p>
                <a v-if="client.website_url" :href="client.website_url" target="_blank" class="mt-2 block font-semibold text-teal-700">{{ client.website_url }}</a>
                <p v-else class="mt-2">No website added</p>
            </div>
        </div>

        <div class="card">
            <h2 class="text-xl font-bold">Projects</h2>
            <div class="mt-4 divide-y">
                <div v-for="project in client.projects" :key="project.id" class="flex items-center justify-between py-4">
                    <div>
                        <p class="font-semibold">{{ project.name }}</p>
                        <p class="text-sm text-slate-500 capitalize">{{ project.type }} · {{ project.status.replaceAll('_', ' ') }}</p>
                    </div>
                    <Link :href="`/projects/${project.id}`" class="font-semibold text-teal-700">Open</Link>
                </div>
            </div>
        </div>
    </section>
</template>
