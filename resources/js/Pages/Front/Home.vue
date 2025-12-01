<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Portfolio" />

  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-md dark:bg-gray-800">
      <div class="flex items-center justify-between px-4 py-4 mx-auto max-w-7xl">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Mon Portfolio</h1>
        <nav>
          <Link href="/" class="text-gray-700 dark:text-gray-200 hover:underline">Accueil</Link>
        </nav>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="py-20 text-center text-white bg-purple-600">
      <h2 class="mb-4 text-4xl font-bold">Bienvenue sur mon portfolio</h2>
      <p class="max-w-2xl mx-auto text-lg">Découvrez mes projets, expériences et formations.</p>
    </section>

    <!-- Projets Section -->
    <section class="px-4 py-16 mx-auto max-w-7xl">
      <h3 class="mb-8 text-3xl font-semibold text-gray-900 dark:text-white">Projets</h3>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- Exemple de projet -->
        <div class="overflow-hidden transition bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg">
          <img src="/images/project-example.jpg" alt="Projet exemple" class="object-cover w-full h-48">
          <div class="p-6">
            <h4 class="mb-2 text-xl font-semibold">Projet 1</h4>
            <p class="text-sm text-gray-600 dark:text-gray-300">Description courte du projet. Technologies utilisées, objectifs, etc.</p>
          </div>
        </div>

        <div class="overflow-hidden transition bg-white rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg">
          <img src="/images/project-example2.jpg" alt="Projet exemple" class="object-cover w-full h-48">
          <div class="p-6">
            <h4 class="mb-2 text-xl font-semibold">Projet 2</h4>
            <p class="text-sm text-gray-600 dark:text-gray-300">Description courte du projet. Technologies utilisées, objectifs, etc.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 mt-16 bg-gray-200 dark:bg-gray-800">
      <div class="px-4 mx-auto text-center text-gray-700 max-w-7xl dark:text-gray-300">
        &copy; 2025 John. Tous droits réservés.
      </div>
    </footer>
  </div>
</template>
