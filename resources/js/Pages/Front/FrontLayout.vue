<template>
  <div class="relative min-h-screen bg-[#000000] text-[#FFFFFF] font-sans">
    <!-- Header -->
    <header
      class="fixed top-0 left-0 w-full flex items-center justify-center px-4 z-50 h-24 backdrop-blur-md bg-[#0F0F2F]/70 shadow-md"
    >
      <!-- Logo à gauche -->
      <router-link to="/" class="absolute left-0 flex items-center h-full pl-4">
        <img src="/images/logo.png" alt="Logo" class="w-auto h-full" />
      </router-link>

      <!-- Wrapper pour centrer nav avec décalage logo -->
      <div class="flex justify-center items-center w-full pl-[100px]">
        <nav class="hidden gap-4 md:flex">
          <router-link
            v-for="item in navItems"
            :key="item.name"
            :to="item.link"
            class="nav-btn"
            :class="{
              'nav-btn-active': page.url === item.link || (item.link === '/' && page.url === '')
            }"
            :disabled="item.disabled"
          >
            {{ item.name }}
          </router-link>
        </nav>
      </div>

      <!-- Hamburger Button -->
      <button @click="mobileMenuOpen = !mobileMenuOpen" class="absolute z-50 md:hidden right-4">
        <svg
          v-if="!mobileMenuOpen"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-8 h-8 text-[#4BE4FF]"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
        </svg>
        <svg
          v-else
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="w-8 h-8 text-[#FF7BC6]"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Menu Mobile -->
      <transition name="slide-right">
        <div
          v-if="mobileMenuOpen"
          class="fixed top-0 right-0 h-full w-64 bg-[#0F2F4F]/90 shadow-lg border-l border-[#4BE4FF] p-6 flex flex-col gap-4 z-40"
        >
          <router-link
            v-for="item in navItems"
            :key="item.name"
            @click="mobileMenuOpen = false"
            :to="item.link"
            class="nav-btn-mobile"
            :class="{'nav-btn-active': page.url === item.link || (item.link === '/' && page.url === '')}"
            :disabled="item.disabled"
          >
            {{ item.name }}
          </router-link>
        </div>
      </transition>
    </header>

    <!-- Main -->
    <main class="pb-16 pt-28">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-[#0F0F2F] text-[#E0E6F0] shadow-inner mt-8">
      <div class="flex flex-col items-center justify-between p-4 mx-auto max-w-7xl md:flex-row">
        <p class="text-sm">&copy; 2025 John. Tous droits réservés.</p>
        <div class="flex gap-4 mt-2 md:mt-0">
          <a href="#" class="text-[#4FA8FF] hover:text-[#88CCFF]">Facebook</a>
          <a href="#" class="text-[#4FA8FF] hover:text-[#88CCFF]">Twitter</a>
          <a href="#" class="text-[#4FA8FF] hover:text-[#88CCFF]">LinkedIn</a>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { usePage } from '@inertiajs/vue3'

export default {
  name: "FrontLayout",
  setup() {
    const page = usePage();

    const navItems = [
      { name: "Accueil", link: "/" },
      { name: "A propos", link: "/a-propos" },
      { name: "Projets Web", link: "/projets-web" },
      { name: "Musique.AI", link: "#", disabled: true },
      { name: "Roman", link: "#", disabled: true },
      { name: "Contact", link: "/contact" },
      { name: "Nethra.IA", link: "/nethra-ia" },
    ];

    return { page, navItems, mobileMenuOpen: false };
  }
}
</script>

<style scoped>
/* Boutons nav */
.nav-btn {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 140px;
  padding: 0.5rem 1rem;
  font-weight: 600;
  color: #EAFBFF;
  border-radius: 0.5rem;
  background: linear-gradient(90deg, #4BE4FF 0%, #38AFFF 25%, #C96BFF 60%, #FF7BC6 80%, #FF6B8A 100%);
  border: 1px solid rgba(75, 228, 255, 0.4);
  opacity: 0.65;
  text-align: center;
  transition: all 0.2s ease-in-out;
}
.nav-btn:hover:not([disabled]),
.nav-btn-active {
  opacity: 1;
  filter: brightness(1.1);
  transform: scale(1.02);
  box-shadow: 0 0 10px rgba(75,228,255,0.3), 0 0 20px rgba(255,107,138,0.2);
}
.nav-btn[disabled] {
  pointer-events: none;
  opacity: 0.5;
}

/* Boutons nav mobile */
.nav-btn-mobile {
  padding: 0.5rem 1rem;
  color: #EAFBFF;
  border-radius: 0.5rem;
  background: linear-gradient(90deg, #4BE4FF 0%, #38AFFF 25%, #C96BFF 60%, #FF7BC6 80%, #FF6B8A 100%);
  opacity: 0.7;
  text-align: center;
}
.nav-btn-mobile:hover:not([disabled]),
.nav-btn-mobile.nav-btn-active {
  opacity: 1;
}

/* Animation menu mobile */
.slide-right-enter-active { transition: transform 0.3s ease-out; }
.slide-right-leave-active { transition: transform 0.3s ease-in; }
.slide-right-enter-from,
.slide-right-leave-to { transform: translateX(100%); }

/* Frosted glass effect pour le header déjà appliqué via backdrop-blur-md et bg-opacity */
</style>
