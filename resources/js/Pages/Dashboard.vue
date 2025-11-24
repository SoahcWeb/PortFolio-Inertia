<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout title="Dashboard">
    <h2 class="mb-6 text-2xl font-bold">Bienvenue dans le Backoffice 🎉</h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
      <Link href="/technologies" class="p-6 font-medium text-center text-blue-700 rounded-lg bg-blue-50 hover:bg-blue-100">Technologies</Link>
      <Link href="/projects" class="p-6 font-medium text-center text-green-700 rounded-lg bg-green-50 hover:bg-green-100">Projets</Link>
      <Link href="/experiences" class="p-6 font-medium text-center text-yellow-700 rounded-lg bg-yellow-50 hover:bg-yellow-100">Expériences</Link>
      <Link href="/formations" class="p-6 font-medium text-center text-purple-700 rounded-lg bg-purple-50 hover:bg-purple-100">Formations</Link>
      <Link href="/personal-info" class="p-6 font-medium text-center text-pink-700 rounded-lg bg-pink-50 hover:bg-pink-100">Infos Perso</Link>
    </div>
  </AuthenticatedLayout>
</template>
