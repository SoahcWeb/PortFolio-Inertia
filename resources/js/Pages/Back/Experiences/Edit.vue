<template>
  <div class="max-w-3xl p-4 mx-auto">
    <h1 class="mb-6 text-2xl font-bold text-center">Modifier l'expérience</h1>
    <ExperienceForm :experience="experience" />
  </div>
</template>

<script setup>
import ExperienceForm from '@/Components/ExperienceForm.vue';
const props = defineProps({
  experience: Object,
});
</script>
