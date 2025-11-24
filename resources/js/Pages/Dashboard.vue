<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />

  <div class="min-h-screen p-6 bg-gray-100">
    <h1 class="mb-4 text-2xl font-bold">Dashboard</h1>
    <p>Bienvenue sur votre Dashboard.</p>

    <Link
      href="/"
      class="inline-block px-6 py-3 mt-4 text-white bg-gray-600 rounded-lg hover:bg-gray-700"
    >
      Retour à l'accueil
    </Link>
  </div>
</template>
