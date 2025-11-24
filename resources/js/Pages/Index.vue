<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Home" />

  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="p-10 text-center bg-white shadow-xl rounded-xl">
      <h1 class="mb-4 text-4xl font-bold text-gray-800">
        Hello John 👋
      </h1>
      <p class="text-lg text-gray-600">
        Votre configuration Laravel + Inertia + Vue fonctionne parfaitement.
      </p>

      <Link
        href="/dashboard"
        class="inline-block px-6 py-3 mt-4 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"
      >
        Aller au Dashboard
      </Link>
    </div>
  </div>
</template>

<style scoped>
/* Exemple de styles supplémentaires si besoin */
</style>
