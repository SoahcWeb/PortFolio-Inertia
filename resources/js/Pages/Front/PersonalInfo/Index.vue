<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ personalInfo: Object });
</script>

<template>
  <Head title="Infos Perso" />
  <AuthenticatedLayout title="Infos Perso">
    <div>
      <h2 class="mb-4 text-xl font-bold">Informations Personnelles</h2>
      <p><strong>Nom :</strong> {{ personalInfo.name }}</p>
      <p><strong>Email :</strong> {{ personalInfo.email }}</p>
      <p><strong>Profession :</strong> {{ personalInfo.job_title }}</p>
      <p><strong>Bio :</strong> {{ personalInfo.bio }}</p>
    </div>
  </AuthenticatedLayout>
</template>
