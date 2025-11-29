<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  title: { type: String, default: 'Laravel' },
  auth: { type: Object, default: () => ({ user: null }) },
  errors: { type: Object, default: () => ({}) },
  flash: { type: Object, default: () => ({}) }, // messages flash
});
</script>

<template>
  <div class="min-h-screen bg-gray-100">

    <!-- Titre de la page -->
    <Head :title="title" />

    <!-- Navbar simple -->
    <nav class="flex justify-between p-4 bg-white shadow">
      <div class="text-lg font-bold">Mon App</div>
      <div>
        <span v-if="auth?.user" class="mr-4">Bonjour, {{ auth.user.name }}</span>
        <Link href="/logout" method="post" class="text-red-600 hover:underline">Se déconnecter</Link>
      </div>
    </nav>

    <!-- Header optionnel -->
    <header class="p-4 mb-6 bg-white shadow" v-if="$slots.header">
      <slot name="header" />
    </header>

    <!-- Flash message -->
    <div v-if="flash?.message" class="p-4 mx-auto mb-4 text-green-800 bg-green-100 rounded max-w-7xl">
      {{ flash.message }}
    </div>

    <!-- Contenu principal -->
    <main class="p-6 mx-auto max-w-7xl">
      <slot />
    </main>

  </div>
</template>
