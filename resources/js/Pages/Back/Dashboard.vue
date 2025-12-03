<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  auth: { type: Object, default: () => ({ user: null }) },
  errors: { type: Object, default: () => ({}) },
  flash: { type: Object, default: () => ({}) },
});
</script>

<template>
  <AuthenticatedLayout
      title="Dashboard"
      :auth="props.auth"
      :errors="props.errors"
      :flash="props.flash"
  >
    <template #header>
      <h2 class="text-2xl font-bold text-[#52c5ff] drop-shadow-md text-center">
        Dashboard
      </h2>
    </template>

    <!-- 🌌 Contenu global -->
    <div class="w-full min-h-screen p-6">

      <!-- Message de bienvenue -->
      <div
        class="bg-[#0F0F2F]/80 shadow-lg shadow-black/40 rounded-xl border border-[#0F0F2F] p-6 mb-8 text-center"
      >
        <p class="text-[#E0E6F0] text-lg">
          Namasté <span class="text-[#52c5ff] font-semibold">{{ auth?.user?.name || 'Utilisateur' }}</span> !
          Votre présence éclaire le sanctuaire.
        </p>
      </div>

      <!-- 🔥 Menu du Dashboard : Infos personnelles en premier -->
      <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-3">

        <!-- 1️⃣ Infos personnelles -->
        <Link
          href="/admin/personal-info"
          class="block p-6 transition rounded-xl shadow-md
                 bg-[#0F0F2F]/80 border border-[#0F0F2F]/50
                 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                 text-center"
        >
          <h3 class="text-xl font-semibold text-[#52c5ff] mb-1">Infos personnelles</h3>
          <p class="text-sm text-[#A8B4C8]">Photo, CV, réseaux, disponibilité</p>
        </Link>

        <!-- 2️⃣ Projets -->
        <Link
          href="/admin/projects"
          class="block p-6 transition rounded-xl shadow-md
                 bg-[#0F0F2F]/80 border border-[#0F0F2F]/50
                 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                 text-center"
        >
          <h3 class="text-xl font-semibold text-[#52c5ff] mb-1">Projets</h3>
          <p class="text-sm text-[#A8B4C8]">Gérer vos projets</p>
        </Link>

        <!-- 3️⃣ Technologies -->
        <Link
          href="/admin/technologies"
          class="block p-6 transition rounded-xl shadow-md
                 bg-[#0F0F2F]/80 border border-[#0F0F2F]/50
                 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                 text-center"
        >
          <h3 class="text-xl font-semibold text-[#52c5ff] mb-1">Technologies</h3>
          <p class="text-sm text-[#A8B4C8]">Gérer vos technologies</p>
        </Link>

        <!-- 4️⃣ Expériences -->
        <Link
          href="/admin/experiences"
          class="block p-6 transition rounded-xl shadow-md
                 bg-[#0F0F2F]/80 border border-[#0F0F2F]/50
                 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                 text-center"
        >
          <h3 class="text-xl font-semibold text-[#52c5ff] mb-1">Expériences</h3>
          <p class="text-sm text-[#A8B4C8]">Expériences professionnelles</p>
        </Link>

        <!-- 5️⃣ Formations -->
        <Link
          href="/admin/formations"
          class="block p-6 transition rounded-xl shadow-md
                 bg-[#0F0F2F]/80 border border-[#0F0F2F]/50
                 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]
                 text-center"
        >
          <h3 class="text-xl font-semibold text-[#52c5ff] mb-1">Formations</h3>
          <p class="text-sm text-[#A8B4C8]">Diplômes et formations</p>
        </Link>

      </div>
    </div>

  </AuthenticatedLayout>
</template>

<style scoped>
/* Optionnel : effet glow léger pour toutes les cartes */
a:hover {
  transition: box-shadow 0.3s ease, transform 0.3s ease;
  transform: translateY(-2px);
  box-shadow: 0 0 20px 5px rgba(201, 107, 255, 0.35);
}
</style>
