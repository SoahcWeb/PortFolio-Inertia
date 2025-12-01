<template>
  <header class="fixed top-0 left-0 z-50 w-full text-white shadow-md bg-nethraBlueDark bg-opacity-90">
    <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">
      <!-- Logo -->
      <router-link to="/">
        <img src="/images/logo.png" alt="Logo" class="w-auto h-12" />
      </router-link>

      <!-- Menu de navigation -->
      <nav>
        <ul class="flex gap-6">
          <li><router-link to="/" class="transition hover:text-nethraAccent">Accueil</router-link></li>
          <li><router-link to="/projets" class="transition hover:text-nethraAccent">Projets</router-link></li>
          <li><router-link to="/experience" class="transition hover:text-nethraAccent">Expérience</router-link></li>
          <li><router-link to="/contact" class="transition hover:text-nethraAccent">Contact</router-link></li>
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
