<template>
  <header class="fixed top-0 left-0 z-50 w-full text-white bg-black shadow-md bg-opacity-90">
    <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">
      <!-- Logo / Nom du site -->
      <h1 class="text-2xl font-bold">MonSite</h1>

      <!-- Menu de navigation -->
      <nav>
        <ul class="flex gap-6">
          <li><router-link to="/" class="transition hover:text-yellow-400">Accueil</router-link></li>
          <li><router-link to="/projets" class="transition hover:text-yellow-400">Projets</router-link></li>
          <li><router-link to="/experience" class="transition hover:text-yellow-400">Expérience</router-link></li>
          <li><router-link to="/contact" class="transition hover:text-yellow-400">Contact</router-link></li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style scoped>
/* Tu peux ajouter ici des styles supplémentaires si besoin */
</style>
