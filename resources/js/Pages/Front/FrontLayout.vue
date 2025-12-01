<template>
  <div class="relative min-h-screen bg-[#000000] text-[#FFFFFF] font-sans">
    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-[#0F0F2F] text-[#E0E6F0] shadow-md z-50">
      <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-[#0F4F8F]">MonSite</h1>

        <!-- Desktop Menu -->
        <nav class="hidden gap-6 md:flex">
          <router-link to="/" class="hover:text-[#4FA8FF] transition duration-200">Accueil</router-link>
          <router-link to="/projets" class="hover:text-[#4FA8FF] transition duration-200">Projets</router-link>
          <router-link to="/experience" class="hover:text-[#4FA8FF] transition duration-200">Expérience</router-link>
          <router-link to="/contact" class="hover:text-[#4FA8FF] transition duration-200">Contact</router-link>
        </nav>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden focus:outline-none">
          <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-[#4FA8FF]">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-[#4FA8FF]">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div v-if="mobileMenuOpen" class="md:hidden bg-[#0F2F4F]">
        <nav class="flex flex-col gap-4 p-4">
          <router-link @click="mobileMenuOpen = false" to="/" class="hover:text-[#88CCFF] transition duration-200">Accueil</router-link>
          <router-link @click="mobileMenuOpen = false" to="/projets" class="hover:text-[#88CCFF] transition duration-200">Projets</router-link>
          <router-link @click="mobileMenuOpen = false" to="/experience" class="hover:text-[#88CCFF] transition duration-200">Expérience</router-link>
          <router-link @click="mobileMenuOpen = false" to="/contact" class="hover:text-[#88CCFF] transition duration-200">Contact</router-link>
        </nav>
      </div>
    </header>

    <!-- Contenu principal -->
    <main class="pt-20 pb-16">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 w-full bg-[#0F0F2F] text-[#E0E6F0] shadow-inner z-50">
      <div class="flex flex-col items-center justify-between p-4 mx-auto max-w-7xl md:flex-row">
        <p class="text-sm">&copy; 2025 MonSite. Tous droits réservés.</p>
        <div class="flex gap-4 mt-2 md:mt-0">
          <a href="#" class="text-[#4FA8FF] hover:text-[#88CCFF] transition duration-200">Facebook</a>
          <a href="#" class="text-[#4FA8FF] hover:text-[#88CCFF] transition duration-200">Twitter</a>
          <a href="#" class="text-[#4FA8FF] hover:text-[#88CCFF] transition duration-200">LinkedIn</a>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "FrontLayout",
  data() {
    return {
      mobileMenuOpen: false,
    };
  },
};
</script>

<style scoped>
/* Glow subtil sur hover */
a:hover {
  text-shadow: 0 0 8px rgba(79,168,255,0.45);
}

/* Smooth transition */
nav > a {
  transition: color 0.2s ease, text-shadow 0.2s ease;
}
</style>
