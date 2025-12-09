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
            <div class="flex flex-col gap-6 px-3 mt-6 mb-6 md:flex-row">

                <!-- Carte droite : Aperçu 40% -->
                <div class="flex-[0.4] group relative block p-4 rounded-xl shadow-md bg-[#0F0F2F]/80 border border-[#0F0F2F]/50">

                    <!-- En-tête avec image et titre -->
                    <div class="relative flex items-center mb-2" style="min-height: 160px; padding-left: 160px;">
                        <img src="/images/Icons/infoperso.png" alt="Info perso"
                             class="absolute object-contain h-35 w-35"
                             style="top:0; left:0;" />
                        <h3 class="text-xl font-semibold text-[#52c5ff]">
                            Aperçu de mon Profil
                        </h3>
                    </div>

                    <!-- Séparateur -->
                    <div class="w-full h-2 my-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

                    <!-- Bloc Infos principales alignées -->
                    <div class="grid grid-cols-[120px_1fr] gap-y-3 mt-4 text-base">
                        <p class="text-[#52c5ff] font-semibold">Prénom :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.first_name || 'Non renseigné' }}</p>

                        <p class="text-[#52c5ff] font-semibold">Nom :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.last_name || 'Non renseigné' }}</p>

                        <p class="text-[#52c5ff] font-semibold">Surnom :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.nickname || 'Non renseigné' }}</p>

                        <p class="text-[#52c5ff] font-semibold">Téléphone :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.phone || 'Non renseigné' }}</p>

                        <p class="text-[#52c5ff] font-semibold">Localisation :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.location || 'Non renseigné' }}</p>

                        <p class="text-[#52c5ff] font-semibold">Métier :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.job_title || 'Non renseigné' }}</p>

                        <p class="text-[#52c5ff] font-semibold">Disponibilité :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.availability || 'Non renseigné' }}</p>
                    </div>

                    <!-- Email -->
                    <div class="grid grid-cols-[120px_1fr] gap-y-3 mt-4">
                        <p class="text-[#52c5ff] font-semibold">Email :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.email || 'Non renseigné' }}</p>
                    </div>

                    <!-- Séparateur -->
                    <div class="w-full h-2 my-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

                    <!-- Bio -->
                    <div class="grid grid-cols-[150px_1fr] gap-y-3 mb-3">
                        <p class="text-[#52c5ff] font-semibold">Bio :</p>
                        <div class="mt-1 col-span-full">
                            <p class="text-[#E0E6F0]">{{ personalInfoReactive.bio || 'Non renseigné' }}</p>
                        </div>
                    </div>

                    <!-- Séparateur -->
                    <div class="w-full h-2 my-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

                    <!-- Réseaux sociaux -->
                    <div class="grid grid-cols-[150px_1fr] gap-y-2 mb-3">
                        <p class="text-[#52c5ff] font-semibold">Réseaux sociaux :</p>
                        <div class="mt-1 col-span-full">
                            <p><span class="text-[#f8786f] font-semibold">LinkedIn :</span> {{ personalInfoReactive.linkedin || 'Non renseigné' }}</p>
                            <p><span class="text-[#f8786f] font-semibold">GitHub :</span> {{ personalInfoReactive.github || 'Non renseigné' }}</p>
                            <p><span class="text-[#f8786f] font-semibold">Twitter :</span> {{ personalInfoReactive.twitter || 'Non renseigné' }}</p>
                            <p><span class="text-[#f8786f] font-semibold">Facebook :</span> {{ personalInfoReactive.facebook || 'Non renseigné' }}</p>
                            <p><span class="text-[#f8786f] font-semibold">YouTube :</span> {{ personalInfoReactive.youtube || 'Non renseigné' }}</p>
                            <p><span class="text-[#f8786f] font-semibold">TikTok :</span> {{ personalInfoReactive.tiktok || 'Non renseigné' }}</p>
                        </div>
                    </div>

                    <!-- Séparateur -->
                    <div class="w-full h-2 my-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

                    <!-- Image Upload -->
                    <div class="mb-3 grid grid-cols-[150px_1fr] gap-y-2">
                        <p class="text-[#52c5ff] font-semibold">Votre image Upload :</p>
                        <div>
                            <img v-if="personalInfoReactive.profile_photo"
                                 :src="`/storage/${personalInfoReactive.profile_photo}`"
                                 alt="Image Profil"
                                 class="object-cover w-32 h-32 mt-1 rounded-md" />
                            <p v-else class="text-[#E0E6F0]">Aucune image</p>
                        </div>
                    </div>

                    <!-- Mon CV enregistré -->
                    <div class="mb-3 grid grid-cols-[150px_1fr] gap-y-2">
                        <p class="text-[#52c5ff] font-semibold">Mon CV enregistré :</p>
                        <p class="text-[#E0E6F0]">{{ personalInfoReactive.cv_path || 'Aucun CV' }}</p>
                    </div>

                </div>

                <!-- Carte gauche : Formulaire 60% -->
                <div class="flex-[0.6]">
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
