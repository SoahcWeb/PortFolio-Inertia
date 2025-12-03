<template>
  <div class="flex h-screen bg-black text-[#E0E6F0] overflow-hidden">

    <!-- SIDEBAR DESKTOP avec image entière alignée sur le haut -->
    <aside class="relative flex-col hidden w-64 overflow-hidden shadow-lg md:flex">

      <!-- Image entière visible, alignée sur le haut -->
      <div class="absolute inset-0 flex items-start justify-center pointer-events-none">
        <img src="/images/sideadmin.png" class="object-contain object-top w-full h-full" />
      </div>

      <div class="relative z-10 flex flex-col h-full">

        <!-- Titre Dashboard agrandi -->
        <div class="flex flex-col items-center p-6 mt-2">
          <h1 class="text-4xl font-bold text-[#52c5ff]">Dashboard</h1>
        </div>

        <!-- Icônes (côte à côte dans le tiers inférieur) avec hover glow identique au dashboard -->
        <div class="absolute flex justify-center w-full space-x-4" style="bottom: 11.5%;">

          <!-- Déconnexion -->
          <a href="/logout" class="flex flex-col items-center">
            <img src="/images/icons/unlock.png"
                 class="w-[105px] h-[105px] rounded-xl border border-[#0F0F2F]/50
                        bg-[#0F0F2F]/80 transition-all duration-300
                        hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                        hover:scale-105" />
            <span class="text-[#52c5ff] mt-2 text-sm font-bold pointer-events-none">Logout</span>
          </a>

          <!-- Retour Dashboard -->
          <a href="/dashboard" class="flex flex-col items-center">
            <img src="/images/icons/retour.png"
                 class="w-[105px] h-[105px] rounded-xl border border-[#0F0F2F]/50
                        bg-[#0F0F2F]/80 transition-all duration-300
                        hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                        hover:scale-105" />
            <span class="text-[#52c5ff] mt-2 text-sm font-bold pointer-events-none">Retour</span>
          </a>
        </div>

      </div>
    </aside>

    <!-- MOBILE HEADER -->
    <header class="flex items-center justify-between p-4 bg-[#0F0F2F] shadow md:hidden">
      <h1 class="text-4xl font-bold text-[#52c5ff]">Dashboard</h1>
      <button @click="mobileOpen = !mobileOpen">
        <svg class="w-6 h-6 text-[#E0E6F0]" fill="none" stroke="currentColor" stroke-width="2">
          <path v-if="!mobileOpen" stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
          <path v-else stroke-linecap="round" stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </header>

    <!-- MOBILE MENU -->
    <transition name="fade">
      <nav
        v-if="mobileOpen"
        class="px-4 pb-4 space-y-1 bg-[#0F0F2F] border-b border-[#1A1A1A] shadow md:hidden"
      >
        <template v-for="item in navItems" :key="item.href">
          <Link
            :href="item.href"
            @click="mobileOpen = false"
            class="flex items-center gap-3 px-3 py-2 text-sm transition rounded-md hover:bg-[#1A1A1A]/70 hover:text-[#C96BFF]"
          >
            <span v-html="Icon(item.icon)"></span>
            <span>{{ item.title }}</span>
          </Link>
        </template>

        <form method="post" action="/logout" class="mt-3">
          <button
            type="submit"
            class="flex items-center w-full gap-2 px-3 py-2 text-left text-red-600 rounded hover:bg-red-900/20"
          >
            <span v-html="Icon('logout')"></span>
            Déconnexion
          </button>
        </form>
      </nav>
    </transition>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 overflow-hidden">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const mobileOpen = ref(false);

const navItems = [
  { title: "Dashboard", href: route("dashboard"), icon: "home" },
  { title: "Projets", href: route("admin.projects.index"), icon: "briefcase" },
  { title: "Infos personnelles", href: route("admin.personal-info.edit"), icon: "user" },
];

function Icon(name, attrs = {}) {
  const icons = {
    home: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955a1.125 1.125 0 011.592 0L21.75 12M4.5 9.75v10.125A1.125 1.125 0 005.625 21h12.75A1.125 1.125 0 0019.5 19.875V9.75" /></svg>`,
    briefcase: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5V6a3 3 0 013-3h4.5a3 3 0 013 3v1.5M3 9h18M3 9l1.125 10.125A2.25 2.25 0 006.375 21h11.25a2.25 2.25 0 002.25-1.875L21 9M3 9h18" /></svg>`,
    user: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0" /></svg>`,
    logout: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3H6A2.25 2.25 0 003.75 5.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>`
  };
  return icons[name] ?? "";
}
</script>

<style>
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-5px);
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.2s ease;
}
</style>
