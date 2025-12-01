<script setup>
import Form from './Form.vue';
const props = defineProps({
  formation: Object
});
</script>

<template>
  <div class="p-4">
    <h1 class="mb-4 text-2xl font-bold">Modifier la formation</h1>

    <!-- route('admin.formations.update', formation.id) attend la méthode PUT -->
    <Form :formation="formation" :submitUrl="route('admin.formations.update', formation.id)" method="put" />
  </div>
</template>
