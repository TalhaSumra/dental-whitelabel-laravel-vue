<script setup>
defineProps({
    title: String,
    value: [String, Number],
    note: String,
});
</script>

<template>
    <div class="card">
        <p class="text-sm font-medium text-slate-500">{{ title }}</p>
        <p class="mt-2 text-3xl font-bold">{{ value }}</p>
        <p v-if="note" class="mt-2 text-sm text-slate-500">{{ note }}</p>
    </div>
</template>
