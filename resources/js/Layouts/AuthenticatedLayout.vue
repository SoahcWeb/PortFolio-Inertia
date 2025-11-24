<script setup>
import { Link, Head } from '@inertiajs/vue3';
const props = defineProps({
  title: String
});
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="flex items-center justify-between p-4 text-white bg-gray-800">
      <h1 class="text-lg font-bold">{{ title || 'Backoffice' }}</h1>
      <nav class="space-x-4">
        <Link href="/dashboard" class="hover:underline">Dashboard</Link>
        <Link href="/technologies" class="hover:underline">Technologies</Link>
        <Link href="/projects" class="hover:underline">Projets</Link>
        <Link href="/experiences" class="hover:underline">Expériences</Link>
        <Link href="/formations" class="hover:underline">Formations</Link>
        <Link href="/personal-info" class="hover:underline">Infos Perso</Link>
      </nav>
    </header>

    <!-- Contenu principal -->
    <main class="flex-1 p-6 bg-gray-100">
      <slot />
    </main>
  </div>
</template>
