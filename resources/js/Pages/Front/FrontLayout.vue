<template>
  <div class="relative min-h-screen bg-[#000000] text-[#FFFFFF] font-sans">

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-[#0F0F2F] text-[#E0E6F0] shadow-md z-50 flex items-center px-4"
            style="height: 100px;">

      <!-- Logo -->
      <router-link to="/" class="flex items-center h-full">
        <img src="/images/logo.png" alt="Logo" class="w-auto h-full" />
      </router-link>

      <!-- Desktop Menu -->
      <nav class="hidden gap-6 ml-6 md:flex">
        <router-link to="/" class="hover:text-[#4FA8FF] transition duration-200">Accueil</router-link>
        <router-link to="/projets" class="hover:text-[#4FA8FF] transition duration-200">Projets</router-link>
        <router-link to="/experience" class="hover:text-[#4FA8FF] transition duration-200">Expérience</router-link>
        <router-link to="/contact" class="hover:text-[#4FA8FF] transition duration-200">Contact</router-link>
      </nav>

      <!-- Mobile Menu Button -->
      <button @click="mobileMenuOpen = !mobileMenuOpen" class="ml-auto md:hidden focus:outline-none">
        <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" class="w-6 h-6 text-[#4FA8FF]">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" class="w-6 h-6 text-[#4FA8FF]">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </header>

    <!-- Mobile Menu -->
    <div v-if="mobileMenuOpen" class="md:hidden bg-[#0F2F4F] mt-[100px]">
      <nav class="flex flex-col gap-4 p-4">
        <router-link @click="mobileMenuOpen = false" to="/" class="hover:text-[#88CCFF] transition duration-200">Accueil</router-link>
        <router-link @click="mobileMenuOpen = false" to="/projets" class="hover:text-[#88CCFF] transition duration-200">Projets</router-link>
        <router-link @click="mobileMenuOpen = false" to="/experience" class="hover:text-[#88CCFF] transition duration-200">Expérience</router-link>
        <router-link @click="mobileMenuOpen = false" to="/contact" class="hover:text-[#88CCFF] transition duration-200">Contact</router-link>
      </nav>
    </div>

    <!-- Contenu principal -->
    <main class="pt-[100px] pb-16">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-[#0F0F2F] text-[#E0E6F0] shadow-inner mt-16">
      <div class="flex flex-col items-center justify-between p-4 mx-auto max-w-7xl md:flex-row">
        <p class="text-sm">&copy; 2025 John. Tous droits réservés.</p>
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

/* Smooth transition pour tous les liens */
nav > a {
  transition: color 0.2s ease, text-shadow 0.2s ease;
}
</style>
