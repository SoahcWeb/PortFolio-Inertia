<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Form from './Form.vue';

const props = defineProps({
  personalInfo: Object,
  auth: { type: Object, default: () => ({ user: null }) },
  errors: { type: Object, default: () => ({}) },
  flash: { type: Object, default: () => ({}) },
});
</script>

<template>
  <AuthenticatedLayout
    title="Modifier mes infos personnelles"
    :auth="props.auth"
    :errors="props.errors"
    :flash="props.flash"
  >
    <template #header>
      <h2 class="text-2xl font-bold text-[#52c5ff] drop-shadow-md text-center">
        Modifier mes infos personnelles
      </h2>
    </template>

    <div class="flex flex-col h-screen">

      <!-- Contenu scrollable identique au dashboard -->
      <div class="flex-1 dashboard-scroll">

        <!-- 🟣 Bloc de présentation identique au dashboard -->
        <div
          class="relative mb-2 p-2 flex items-center overflow-hidden rounded-xl bg-[#0F0F2F]/80"
          style="border: 4px solid; border-image: linear-gradient(to right, #0F0F2F, #0F4F8F, #0F0F2F) 1;"
        >
          <img
            :src="props.personalInfo.profile_photo ? `/storage/${props.personalInfo.profile_photo}` : '/images/Icons/dashboard.png'"
            alt="Photo profil"
            class="w-[80px] h-[80px] object-cover rounded-xl flex-shrink-0 mr-4"
          />
          <div class="absolute inset-0 flex items-center justify-center px-4">
            <p class="text-[#E0E6F0] font-semibold text-center leading-tight text-1xl sm:text-2xl md:text-3xl lg:text-3xl break-words">
              Modifiez vos informations,
              <span class="text-[#52c5ff]">{{ props.auth?.user?.name || 'Utilisateur' }}</span>
              pour un profil complet et à jour.
            </p>
          </div>
        </div>

        <!-- 🔹 Grille des cartes identique au dashboard -->
        <div class="grid grid-cols-1 gap-6 px-3 mt-6 mb-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

          <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 text-center">
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">Nom complet</h3>
            <p class="text-sm text-[#E0E6F0]">{{ props.auth?.user?.name || 'Non renseigné' }}</p>
          </div>

          <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 text-center">
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">Email</h3>
            <p class="text-sm text-[#E0E6F0]">{{ props.auth?.user?.email || 'Non renseigné' }}</p>
          </div>

          <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 text-center md:col-span-2 lg:col-span-2">
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">Photo</h3>
            <img
              :src="props.personalInfo.profile_photo ? `/storage/${props.personalInfo.profile_photo}` : '/images/default-avatar.png'"
              class="object-cover w-32 h-32 mx-auto rounded-full"
            />
          </div>

          <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 text-center">
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">Titre professionnel</h3>
            <p class="text-sm text-[#E0E6F0]">{{ props.personalInfo.title || 'Non renseigné' }}</p>
          </div>

          <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 text-center">
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">Bio</h3>
            <p class="text-sm text-[#E0E6F0]">{{ props.personalInfo.bio || 'Non renseigné' }}</p>
          </div>

          <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50 text-center md:col-span-3 lg:col-span-3">
            <h3 class="text-xl font-semibold text-[#52c5ff] mb-2">Réseaux sociaux</h3>
            <p class="text-sm text-[#E0E6F0]">
              <template v-if="props.personalInfo.social_links?.length">
                <ul class="pl-5 list-disc">
                  <li v-for="(link, i) in props.personalInfo.social_links" :key="i">
                    <a :href="link.url" class="text-[#52c5ff] hover:underline" target="_blank">{{ link.platform }}</a>
                  </li>
                </ul>
              </template>
              <template v-else>
                Aucun lien renseigné.
              </template>
            </p>
          </div>

        </div>

        <!-- 🔥 Formulaire éditable centré -->
        <div class="max-w-2xl mx-auto bg-[#0F0F2F]/80 p-6 rounded-xl shadow-md border border-[#0F0F2F]/50 px-3">
          <Form
            :personalInfo="props.personalInfo"
            :submitUrl="route('admin.personal-info.update')"
            method="put"
          />
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.dashboard-scroll {
  flex: 1;
  overflow-y: scroll;
  padding-right: 12px;
  margin-right: -6px;
}

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

.dashboard-scroll {
  scrollbar-width: thin;
  scrollbar-color: #52c5ff rgba(15,15,47,0.8);
}
</style>
