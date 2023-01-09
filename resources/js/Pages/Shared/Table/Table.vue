<template>
    <div class="overflow-hidden overflow-x-auto rounded-lg border border-gray-200 my-5">    
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900" v-for="header in headers" :key="header">
                        <div class="flex items-center gap-2">{{ header }}</div>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white" wire:loading.class.delay="opacity-25">
                <slot/>    
            </tbody>
        </table>
    </div>
</template>

<script setup>
const props = defineProps({
  headers: Array
})
</script>