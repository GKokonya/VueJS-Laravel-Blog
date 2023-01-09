<template>
    <div class="flex">
        <div  v-for="link in links" :key="link.label">
            <Link
            class="px-1"
            v-if="link.url"
            v-html="link.label"
            :href="link.url"
            :class="{'font-bold':link.active}"
            />
            <span v-else v-html="link.label" class="text-gray-400"></span>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps({
    links:Array,
});
</script>
