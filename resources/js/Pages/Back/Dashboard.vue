<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

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

    <!-- 🔥 Menu du Dashboard -->
    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-3">

      <!-- 📌 Projets -->
      <Link href="/admin/projects"
        class="block p-6 transition bg-white rounded-lg shadow-sm hover:shadow-md">
        <h3 class="text-lg font-semibold">Projets</h3>
        <p class="text-sm text-gray-600">Gérer vos projets</p>
      </Link>

      <!-- 📌 Technologies -->
      <Link href="/admin/technologies"
        class="block p-6 transition bg-white rounded-lg shadow-sm hover:shadow-md">
        <h3 class="text-lg font-semibold">Technologies</h3>
        <p class="text-sm text-gray-600">Gérer vos technologies</p>
      </Link>

      <!-- 📌 Expériences -->
      <Link href="/admin/experiences"
        class="block p-6 transition bg-white rounded-lg shadow-sm hover:shadow-md">
        <h3 class="text-lg font-semibold">Expériences</h3>
        <p class="text-sm text-gray-600">Gérer vos expériences professionnelles</p>
      </Link>

      <!-- 📌 Formations -->
      <Link href="/admin/formations"
        class="block p-6 transition bg-white rounded-lg shadow-sm hover:shadow-md">
        <h3 class="text-lg font-semibold">Formations</h3>
        <p class="text-sm text-gray-600">Gérer vos diplômes et formations</p>
      </Link>

      <!-- 🔥 Infos personnelles -->
      <Link href="/admin/personal-info"
        class="block p-6 transition bg-white rounded-lg shadow-sm hover:shadow-md">
        <h3 class="text-lg font-semibold">Infos personnelles</h3>
        <p class="text-sm text-gray-600">Photo, CV, réseaux, disponibilité</p>
      </Link>

    </div>
  </AuthenticatedLayout>
</template>
