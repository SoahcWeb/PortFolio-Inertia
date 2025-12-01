<script setup>
import { Head } from '@inertiajs/vue3';
import FrontLayout from '@/Pages/Front/FrontLayout.vue';
</script>

<template>
  <FrontLayout>
    <Head title="Portfolio" />

    <!-- Séparateur fin noir entre header et Hero -->
    <div class="w-full h-2 bg-[#000000]"></div>

    <!-- Hero Section -->
    <section class="py-32 text-center bg-[#0F0F2F] relative overflow-hidden">
      <h2 class="mb-4 text-5xl font-bold text-[#4FA8FF]">Bienvenue sur mon portfolio</h2>
      <p class="max-w-2xl mx-auto text-lg text-[#E0E6F0]">
        Découvrez mes projets, expériences et formations.
      </p>

      <!-- Optionnel : petites particules / glow -->
      <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
        <!-- Canvas ou divs pour effet cosmique -->
      </div>
    </section>

    <!-- Projets Section -->
    <section class="px-4 py-16 mx-auto max-w-7xl">
      <h3 class="mb-8 text-4xl font-semibold text-[#88CCFF]">Projets</h3>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- Exemple de projet -->
        <div class="overflow-hidden transition bg-[#0A0A14] rounded-lg shadow-md hover:shadow-lg border border-[#1E2F4F]">
          <img src="/images/project-example.jpg" alt="Projet exemple" class="object-cover w-full h-48">
          <div class="p-6">
            <h4 class="mb-2 text-xl font-semibold text-[#4FA8FF]">Projet 1</h4>
            <p class="text-sm text-[#A8B4C8]">Description courte du projet.</p>
          </div>
        </div>

        <div class="overflow-hidden transition bg-[#0A0A14] rounded-lg shadow-md hover:shadow-lg border border-[#1E2F4F]">
          <img src="/images/project-example2.jpg" alt="Projet exemple" class="object-cover w-full h-48">
          <div class="p-6">
            <h4 class="mb-2 text-xl font-semibold text-[#4FA8FF]">Projet 2</h4>
            <p class="text-sm text-[#A8B4C8]">Description courte du projet.</p>
          </div>
        </div>
      </div>
    </section>
  </FrontLayout>
</template>
