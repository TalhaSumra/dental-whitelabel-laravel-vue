<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
}
</script>

<template>
    <main class="flex min-h-screen items-center justify-center bg-slate-50 px-6">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                <p class="text-sm font-bold uppercase tracking-wide text-teal-700">Dental Growth Portal</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-950">Sign in</h1>
                <p class="mt-2 text-slate-600">Access your white-label dental agency dashboard.</p>
            </div>

            <form class="card space-y-4" @submit.prevent="submit">
                <div>
                    <label class="label">Email</label>
                    <input v-model="form.email" type="email" class="input" required autofocus />
                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                </div>
                <div>
                    <label class="label">Password</label>
                    <input v-model="form.password" type="password" class="input" required />
                    <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input v-model="form.remember" type="checkbox" class="rounded border-slate-300" />
                    Remember me
                </label>
                <button class="btn-primary w-full justify-center" :disabled="form.processing">Sign in</button>
                <p class="text-center text-sm text-slate-500">
                    <Link href="/" class="font-semibold text-teal-700">Back to public site</Link>
                </p>
            </form>
        </div>
    </main>
</template>
