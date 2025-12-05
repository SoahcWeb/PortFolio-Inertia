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

    <!-- 🌌 Conteneur principal -->
    <div class="flex flex-col h-screen">

      <!-- Contenu scrollable sans padding, scrollbar proche du bord -->
      <div class="flex-1 dashboard-scroll">

        <!-- 🟣 Message de bienvenue -->
        <div
          class="relative mb-2 p-2 flex items-center overflow-hidden rounded-xl bg-[#0F0F2F]/80"
          style="border: 4px solid; border-image: linear-gradient(to right, #0F0F2F, #0F4F8F, #0F0F2F) 1;"
        >
          <img
            src="/images/icons/dashboard.png"
            alt="Dashboard"
            class="w-[80px] h-[80px] object-cover rounded-xl flex-shrink-0 mr-4"
          />
          <div class="absolute inset-0 flex items-center justify-center px-4">
            <p class="text-[#E0E6F0] font-semibold text-center leading-tight text-1xl sm:text-2xl md:text-3xl lg:text-3xl break-words">
              Namasté
              <span class="text-[#52c5ff]">{{ props.auth?.user?.name || 'Utilisateur' }}</span>
              <span class="text-[#52c5ff]">!</span>
              Votre présence éclaire le sanctuaire.
            </p>
          </div>
        </div>

        <!-- 🔥 Menu du Dashboard -->
        <div class="grid grid-cols-1 gap-6 px-3 mt-6 md:grid-cols-2 lg:grid-cols-3">

          <!-- 1️⃣ Infos personnelles -->
          <Link
            href="/admin/personal-info"
            class="group block p-6 transition-all duration-300 ease-in-out rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] text-center"
          >
            <img src="/images/icons/infoperso.png" alt="Infos personnelles" class="w-[96px] h-[96px] mx-auto mb-2"/>
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">
              Infos personnelles
            </h3>
            <p class="text-sm text-[#E0E6F0]">
              Gestion complète de vos informations personnelles : photo, titre professionnel, bio, coordonnées, CV et liens sociaux. Centralisez toutes vos données pour un profil à jour et complet.
            </p>
          </Link>

          <!-- 2️⃣ Projets -->
          <Link
            href="/admin/projects"
            class="group block p-6 transition-all duration-300 ease-in-out rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] text-center"
          >
            <img src="/images/icons/projet.png" alt="Projets" class="w-[96px] h-[96px] mx-auto mb-2"/>
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">
              Projets
            </h3>
            <p class="text-sm text-[#E0E6F0]">
              Ajoutez, modifiez et organisez vos projets : titre, description courte et détaillée, technologies, galerie d’images et liens externes. Suivi de l’avancement et publication sur votre portfolio.
            </p>
          </Link>

          <!-- 3️⃣ Technologies -->
          <Link
            href="/admin/technologies"
            class="group block p-6 transition-all duration-300 ease-in-out rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] text-center"
          >
            <img src="/images/icons/techno.png" alt="Technologies" class="w-[96px] h-[96px] mx-auto mb-2"/>
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">
              Technologies
            </h3>
            <p class="text-sm text-[#E0E6F0]">
              Gérez vos compétences techniques et créatives : nom, catégorie, niveau, logo et couleur. Classez vos technologies pour les présenter efficacement sur votre portfolio.
            </p>
          </Link>

          <!-- 4️⃣ Expériences -->
          <Link
            href="/admin/experiences"
            class="group block p-6 transition-all duration-300 ease-in-out rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] text-center"
          >
            <img src="/images/icons/experiences.png" alt="Expériences" class="w-[96px] h-[96px] mx-auto mb-2"/>
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">
              Expériences
            </h3>
            <p class="text-sm text-[#E0E6F0]">
              Ajoutez vos expériences professionnelles et stages : poste, entreprise, durée, type de contrat et description détaillée. Créez une timeline claire et structurée de votre parcours.
            </p>
          </Link>

          <!-- 5️⃣ Formations -->
          <Link
            href="/admin/formations"
            class="group block p-6 transition-all duration-300 ease-in-out rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] text-center"
          >
            <img src="/images/icons/formations.png" alt="Formations" class="w-[96px] h-[96px] mx-auto mb-2"/>
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">
              Formations
            </h3>
            <p class="text-sm text-[#E0E6F0]">
              Organisez vos diplômes et formations : établissement, dates, description et spécialités. Présentez votre parcours académique de manière claire et professionnelle.
            </p>
          </Link>

          <!-- 6️⃣ Nethra LifeDesk -->
          <div class="group block p-6 transition-all duration-300 ease-in-out rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 hover:border-[#C96BFF] hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] text-center">
            <img src="/images/icons/lifedesk.png" alt="Nethra LifeDesk" class="w-[96px] h-[96px] mx-auto mb-2 rounded object-cover"/>
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">
              Nethra LifeDesk
            </h3>
            <p class="text-sm text-[#E0E6F0] leading-snug">
              Nethra LifeDesk centralise votre quotidien : calendrier interactif,
              tâches personnelles et de groupe, gestion des anniversaires,
              liste de courses, bloc-notes et statistiques.
              Une plateforme claire et intuitive pour organiser chaque jour.
            </p>
          </div>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
/* Hover des liens */
a:hover {
  transition: box-shadow 0.3s ease, transform 0.3s ease;
  transform: translateY(-2px);
  box-shadow: 0 0 20px 5px rgba(201, 107, 255, 0.35);
}

/* Scrollbar personnalisée */
.dashboard-scroll {
  flex: 1;
  overflow-y: scroll; /* Toujours visible */
  padding-right: 12px; /* Empêche la barre de scroll de toucher le bloc Namasté */
  margin-right: -6px;  /* Rapproche visuellement la scrollbar du bord droit */
}

/* Webkit */
.dashboard-scroll::-webkit-scrollbar {
  width: 8px;
}

.dashboard-scroll::-webkit-scrollbar-track {
  background: rgba(15,15,47,0.8);
  border-radius: 8px;
}

.dashboard-scroll::-webkit-scrollbar-thumb {
  background-color: #52c5ff;
  border-radius: 8px;
  border: 2px solid rgba(15,15,47,0.8);
}

/* Firefox */
.dashboard-scroll {
  scrollbar-width: thin;
  scrollbar-color: #52c5ff rgba(15,15,47,0.8);
}
</style>
