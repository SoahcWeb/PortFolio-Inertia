<template>
  <div class="flex min-h-screen bg-black text-[#E0E6F0]">

    <!-- SIDEBAR DESKTOP avec image entière alignée en haut -->
    <aside class="relative flex-col hidden w-64 overflow-hidden shadow-lg md:flex">

      <!-- Image entière visible, alignée sur le haut -->
      <div class="absolute inset-0 flex items-start justify-center pointer-events-none">
        <img src="/images/sideadmin.png" class="object-contain object-top w-full h-full" />
      </div>

      <!-- Overlay sombre pour lisibilité -->
      <div class="absolute inset-0 bg-black/50"></div>

      <div class="relative z-10 flex flex-col h-full">

        <!-- Titre Dashboard -->
        <div class="p-6 border-b border-[#1A1A1A] flex flex-col items-center">
          <h1 class="text-xl font-bold text-[#52c5ff]">Dashboard</h1>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 flex-1 px-2 py-4 space-y-1">
          <template v-for="item in navItems" :key="item.href">
            <Link
              :href="item.href"
              class="flex items-center gap-3 px-3 py-2 text-sm text-[#E0E6F0] transition rounded-md hover:bg-[#1A1A1A]/70 hover:text-[#C96BFF]"
              :class="{ 'bg-[#1A1A1A]/50 text-[#C96BFF] font-semibold': route().current(item.href.replace('/', '.')) }"
            >
              <span v-html="Icon(item.icon, { class: 'h-5 w-5' })"></span>
              <span>{{ item.title }}</span>
            </Link>
          </template>
        </nav>

        <!-- Déconnexion -->
        <form method="post" action="/logout" class="p-4 border-t border-[#1A1A1A] relative z-10">
          <button
            type="submit"
            class="flex items-center gap-3 px-3 py-2 text-sm text-red-600 rounded-md hover:bg-red-900/20"
          >
            <span v-html="Icon('logout')"></span>
            Déconnexion
          </button>
        </form>

      </div>
    </aside>

    <!-- MOBILE HEADER -->
    <header class="flex items-center justify-between p-4 bg-[#0F0F2F] shadow md:hidden">
      <h1 class="text-lg font-bold text-[#52c5ff]">Dashboard</h1>
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
    <main class="flex-1 p-6">
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
