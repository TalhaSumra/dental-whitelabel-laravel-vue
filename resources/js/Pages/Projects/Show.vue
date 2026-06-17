<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

const props = defineProps({ project: Object });

const taskForm = useForm({
    title: '',
    description: '',
    status: 'todo',
    visibility: 'internal',
    due_date: '',
});

function addTask() {
    taskForm.post(`/projects/${props.project.id}/tasks`, { onSuccess: () => taskForm.reset() });
}
</script>

<template>
    <section class="space-y-6">
        <div>
            <p class="text-sm font-semibold uppercase text-teal-700">{{ project.client?.clinic_name }}</p>
            <h1 class="text-3xl font-bold">{{ project.name }}</h1>
            <p class="mt-2 text-slate-600 capitalize">{{ project.type }} · {{ project.status.replaceAll('_', ' ') }}</p>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="card">
                <p class="text-sm text-slate-500">Client price</p>
                <p class="mt-2 text-2xl font-bold">CAD ${{ project.client_price_cad }}</p>
            </div>
            <div v-if="project.white_label_cost_cad !== undefined" class="card">
                <p class="text-sm text-slate-500">White-label cost</p>
                <p class="mt-2 text-2xl font-bold">CAD ${{ project.white_label_cost_cad }}</p>
            </div>
            <div class="card">
                <p class="text-sm text-slate-500">Due date</p>
                <p class="mt-2 text-2xl font-bold">{{ project.due_date || 'Not set' }}</p>
            </div>
        </div>

        <div class="card">
            <h2 class="text-xl font-bold">Scope</h2>
            <p class="mt-3 whitespace-pre-line text-slate-700">{{ project.scope || 'No scope added.' }}</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="card">
                <h2 class="text-xl font-bold">Tasks</h2>
                <div class="mt-4 divide-y">
                    <div v-for="task in project.tasks" :key="task.id" class="py-4">
                        <p class="font-semibold">{{ task.title }}</p>
                        <p class="text-sm text-slate-500 capitalize">{{ task.status }} · {{ task.visibility.replace('_', ' ') }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2 class="text-xl font-bold">Deliverables</h2>
                <div class="mt-4 divide-y">
                    <div v-for="deliverable in project.deliverables" :key="deliverable.id" class="py-4">
                        <p class="font-semibold">{{ deliverable.title }}</p>
                        <p class="text-sm text-slate-500 capitalize">{{ deliverable.status.replaceAll('_', ' ') }}</p>
                        <a v-if="deliverable.external_url" :href="deliverable.external_url" target="_blank" class="text-sm font-semibold text-teal-700">Open</a>
                    </div>
                </div>
            </div>
        </div>

        <form v-if="project.white_label_cost_cad !== undefined" class="card space-y-4" @submit.prevent="addTask">
            <h2 class="text-xl font-bold">Add internal task</h2>
            <input v-model="taskForm.title" class="input" placeholder="Task title" required />
            <textarea v-model="taskForm.description" rows="3" class="input" placeholder="Task notes"></textarea>
            <div class="grid gap-4 md:grid-cols-2">
                <select v-model="taskForm.status" class="input">
                    <option value="todo">Todo</option>
                    <option value="doing">Doing</option>
                    <option value="review">Review</option>
                    <option value="done">Done</option>
                    <option value="blocked">Blocked</option>
                </select>
                <select v-model="taskForm.visibility" class="input">
                    <option value="internal">Internal only</option>
                    <option value="client_visible">Client visible</option>
                </select>
            </div>
            <button class="btn-primary">Add task</button>
        </form>
    </section>
</template>
