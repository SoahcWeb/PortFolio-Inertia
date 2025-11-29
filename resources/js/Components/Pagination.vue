<script setup>
import { Inertia } from '@inertiajs/inertia';
const props = defineProps({
    links: { type: Array, required: true }
});

function goToPage(url) {
    if (url) Inertia.visit(url, { preserveState: true, replace: true });
}
</script>

<template>
  <div class="flex justify-center gap-2 mt-4">
    <button
      v-for="link in links"
      :key="link.label"
      :disabled="!link.url"
      @click="goToPage(link.url)"
      v-html="link.label"
      class="px-3 py-1 rounded hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
      :class="{'bg-gray-200': link.active, 'bg-gray-100': !link.active}"
    ></button>
  </div>
</template>
