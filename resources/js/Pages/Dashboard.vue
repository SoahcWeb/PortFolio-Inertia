<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  auth: { type: Object, default: () => ({ user: null }) },
  errors: { type: Object, default: () => ({}) },
  flash: { type: Object, default: () => ({}) },
});
</script>

<template>
  <AuthenticatedLayout
      title="Dashboard"
      :auth="props.auth"
      :errors="props.errors"
      :flash="props.flash"
  >
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    </template>

    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        Bonjour {{ auth?.user?.name || 'Utilisateur' }} ! Vous êtes connecté.
      </div>
    </div>
  </AuthenticatedLayout>
</template>
