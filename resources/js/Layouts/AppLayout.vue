<script setup>
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();

function logout() {
    router.post('/logout');
}
</script>

<template>
    <div class="min-h-screen">
        <header class="border-b bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <Link href="/dashboard" class="text-lg font-bold text-teal-800">
                    Dental Growth Portal
                </Link>
                <nav class="flex items-center gap-4 text-sm font-medium">
                    <Link href="/dashboard">Dashboard</Link>
                    <Link v-if="page.props.auth?.user?.role !== 'client'" href="/clients">Clients</Link>
                    <Link v-if="page.props.auth?.user?.role === 'agency_admin'" href="/settings/agency">Settings</Link>
                    <span v-if="page.props.auth?.user" class="text-slate-400">|</span>
                    <span v-if="page.props.auth?.user" class="text-slate-600">{{ page.props.auth.user.name }}</span>
                    <button v-if="page.props.auth?.user" type="button" class="font-semibold text-teal-700" @click="logout">Log out</button>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-8">
            <div v-if="page.props.flash?.success" class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                {{ page.props.flash.success }}
            </div>
            <slot />
        </main>
    </div>
</template>
