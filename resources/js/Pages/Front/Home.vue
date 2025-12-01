<script setup>
import { Head } from '@inertiajs/vue3';
import FrontLayout from './FrontLayout.vue';
</script>

<template>
  <Head title="Portfolio" />

  <FrontLayout>
    <!-- Hero Section -->
    <section class="pt-16 pb-20 text-center bg-nethraBlueDark">
      <h2 class="mb-4 text-4xl font-bold text-nethraAccent shadow-nethra-glow">
        Bienvenue sur mon portfolio
      </h2>
      <p class="max-w-2xl mx-auto text-lg text-nethraLightGray">
        Découvrez mes projets, expériences et formations.
      </p>
    </section>

    <!-- Projets Section -->
    <section class="px-4 py-16 mx-auto max-w-7xl">
      <h3 class="mb-8 text-3xl font-semibold text-nethraHighlight shadow-nethra-glow-soft">
        Projets
      </h3>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- Projet 1 -->
        <div class="overflow-hidden transition border rounded-lg shadow-md bg-nethraDark hover:shadow-nethra-glow border-nethraSteel project-card">
          <img src="/images/project-example.jpg" alt="Projet exemple" class="object-cover w-full h-48">
          <div class="p-6">
            <h4 class="mb-2 text-xl font-semibold text-nethraAccent">Projet 1</h4>
            <p class="text-nethraGrayBlue">
              Description courte du projet. Technologies utilisées, objectifs, etc.
            </p>
          </div>
        </div>

        <!-- Projet 2 -->
        <div class="overflow-hidden transition border rounded-lg shadow-md bg-nethraDark hover:shadow-nethra-glow border-nethraSteel project-card">
          <img src="/images/project-example2.jpg" alt="Projet exemple" class="object-cover w-full h-48">
          <div class="p-6">
            <h4 class="mb-2 text-xl font-semibold text-nethraAccent">Projet 2</h4>
            <p class="text-nethraGrayBlue">
              Description courte du projet. Technologies utilisées, objectifs, etc.
            </p>
          </div>
        </div>
      </div>
    </section>
  </FrontLayout>
</template>

<style scoped>
/* Glow sur titres et cartes */
.project-card h4 {
  transition: all 0.2s ease;
}

.project-card:hover h4 {
  text-shadow: 0 0 12px rgba(79,168,255,0.45);
}
</style>
