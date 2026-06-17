<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

defineProps({ clients: Object });
</script>

<template>
    <section class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Clients</h1>
                <p class="mt-1 text-slate-600">Dental clinics, leads, active retainers, and paused accounts.</p>
            </div>
            <Link href="/clients/create" class="btn-primary">Add client</Link>
        </div>

        <div class="card overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-slate-500">
                        <th class="py-3">Clinic</th>
                        <th class="py-3">City</th>
                        <th class="py-3">Province</th>
                        <th class="py-3">Status</th>
                        <th class="py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients.data" :key="client.id" class="border-b last:border-0">
                        <td class="py-3 font-semibold">{{ client.clinic_name }}</td>
                        <td class="py-3">{{ client.city || '-' }}</td>
                        <td class="py-3">{{ client.province || '-' }}</td>
                        <td class="py-3 capitalize">{{ client.status }}</td>
                        <td class="py-3 text-right"><Link :href="`/clients/${client.id}`" class="font-semibold text-teal-700">Open</Link></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
