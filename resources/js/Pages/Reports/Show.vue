<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({ layout: AppLayout });

defineProps({ agency: Object, report: Object });
</script>

<template>
    <section class="mx-auto max-w-4xl space-y-6">
        <div class="card">
            <p class="text-sm font-semibold uppercase text-teal-700">{{ agency.agency_name }}</p>
            <h1 class="mt-2 text-3xl font-bold">Monthly Growth Report</h1>
            <p class="mt-2 text-slate-600">{{ report.client.clinic_name }} · {{ report.month }}/{{ report.year }}</p>
        </div>

        <div class="card">
            <h2 class="text-xl font-bold">Executive summary</h2>
            <p class="mt-3 whitespace-pre-line text-slate-700">{{ report.summary || 'No summary added yet.' }}</p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div v-for="(value, key) in report.metrics" :key="key" class="card">
                <p class="text-sm text-slate-500">{{ key.replaceAll('_', ' ') }}</p>
                <p class="mt-2 text-2xl font-bold">{{ value }}</p>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="card">
                <h2 class="text-xl font-bold">Completed work</h2>
                <ul class="mt-3 list-disc space-y-2 pl-5 text-slate-700">
                    <li v-for="item in report.completed_work" :key="item">{{ item }}</li>
                </ul>
            </div>
            <div class="card">
                <h2 class="text-xl font-bold">Next month plan</h2>
                <ul class="mt-3 list-disc space-y-2 pl-5 text-slate-700">
                    <li v-for="item in report.next_month_plan" :key="item">{{ item }}</li>
                </ul>
            </div>
        </div>

        <p class="text-center text-sm text-slate-500">{{ agency.client_report_footer }}</p>
    </section>
</template>
