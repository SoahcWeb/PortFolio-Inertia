<script setup>
import { reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Form from './Form.vue';

const props = defineProps({
    personalInfo: Object,
    auth: { type: Object, default: () => ({ user: null }) },
    errors: { type: Object, default: () => ({}) },
    flash: { type: Object, default: () => ({}) },
});

// Création d'une version réactive pour permettre la mise à jour instantanée de la carte
const personalInfoReactive = reactive({ ...props.personalInfo });
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
        <div class="flex-1 dashboard-scroll">

            <!-- Bloc de présentation -->
            <div class="relative mb-2 p-2 flex items-center overflow-hidden rounded-xl bg-[#0F0F2F]/80"
                 style="border: 4px solid; border-image: linear-gradient(to right, #0F0F2F, #0F4F8F, #0F0F2F) 1;">
                <img :src="personalInfoReactive.profile_photo ? `/storage/${personalInfoReactive.profile_photo}` : '/images/Icons/dashboard.png'"
                     alt="Photo profil"
                     class="w-[80px] h-[80px] object-cover rounded-xl flex-shrink-0 mr-4" />
                <div class="absolute inset-0 flex items-center justify-center px-4">
                    <p class="text-[#E0E6F0] font-semibold text-center leading-tight text-1xl sm:text-2xl md:text-3xl lg:text-3xl break-words">
                        Vos infos, <span class="text-[#52c5ff]">{{ props.auth?.user?.name || 'Utilisateur' }}</span>, en un coup d’œil.
                    </p>
                </div>
            </div>

            <!-- Grille : Formulaire + Carte -->
            <div class="grid grid-cols-1 gap-6 px-3 mt-6 mb-6 md:grid-cols-2">

                <!-- Carte droite : aperçu -->
                <div class="group block p-6 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50">
                    <h3 class="text-xl font-semibold text-[#52c5ff] mb-4 text-center">Mes informations personnelles</h3>
                    <div class="flex justify-center mb-4">
                        <img :src="personalInfoReactive.profile_photo ? `/storage/${personalInfoReactive.profile_photo}` : '/images/default-avatar.png'"
                             class="object-cover w-32 h-32 rounded-full" />
                    </div>
                    <div class="mb-2">
                        <p class="text-sm text-[#52c5ff] font-semibold">Nom complet :</p>
                        <p class="text-sm text-[#E0E6F0]">{{ personalInfoReactive.full_name || 'Non renseigné' }}</p>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm text-[#52c5ff] font-semibold">Email :</p>
                        <p class="text-sm text-[#E0E6F0]">{{ personalInfoReactive.email || 'Non renseigné' }}</p>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm text-[#52c5ff] font-semibold">Titre professionnel :</p>
                        <p class="text-sm text-[#E0E6F0]">{{ personalInfoReactive.job_title || 'Non renseigné' }}</p>
                    </div>
                    <div class="mb-2">
                        <p class="text-sm text-[#52c5ff] font-semibold">Bio :</p>
                        <p class="text-sm text-[#E0E6F0]">{{ personalInfoReactive.bio || 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-[#52c5ff] font-semibold">Réseaux sociaux :</p>
                        <p class="text-sm text-[#E0E6F0]">
                            LinkedIn : {{ personalInfoReactive.linkedin || 'Non renseigné' }}<br>
                            GitHub : {{ personalInfoReactive.github || 'Non renseigné' }}<br>
                            Twitter : {{ personalInfoReactive.twitter || 'Non renseigné' }}<br>
                            Disponibilité : {{ personalInfoReactive.availability || 'Non renseigné' }}
                        </p>
                    </div>
                </div>

                <!-- Carte gauche : Formulaire -->
                <div>
                    <Form :personalInfo="personalInfoReactive" :submitUrl="route('admin.personal-info.update')" method="put" />
                </div>
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
.dashboard-scroll::-webkit-scrollbar { width: 8px; }
.dashboard-scroll::-webkit-scrollbar-track { background: rgba(15,15,47,0.8); border-radius: 8px; }
.dashboard-scroll::-webkit-scrollbar-thumb { background-color: #52c5ff; border-radius: 8px; border: 2px solid rgba(15,15,47,0.8); }
.dashboard-scroll { scrollbar-width: thin; scrollbar-color: #52c5ff rgba(15,15,47,0.8); }
</style>
