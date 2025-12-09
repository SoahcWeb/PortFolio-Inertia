<script setup>
import { useForm } from '@inertiajs/vue3';
import { watch, ref } from 'vue';

const props = defineProps({
  personalInfo: { type: Object, default: () => ({}) },
  submitUrl: { type: String, default: '' },
  method: { type: String, default: 'put' }
});

const form = useForm({
  // Identité
  first_name: props.personalInfo.first_name || '',
  last_name: props.personalInfo.last_name || '',
  nickname: props.personalInfo.nickname || '',

  // Coordonnées
  email: props.personalInfo.email || '',
  phone: props.personalInfo.phone || '',
  location: props.personalInfo.location || '',

  // Métier & disponibilité
  job_title: props.personalInfo.job_title || '',
  availability: props.personalInfo.availability || '',

  // Bio
  bio: props.personalInfo.bio || '',

  // Réseaux sociaux
  linkedin: props.personalInfo.linkedin || '',
  github: props.personalInfo.github || '',
  twitter: props.personalInfo.twitter || '',
  facebook: props.personalInfo.facebook || '',
  youtube: props.personalInfo.youtube || '',
  tiktok: props.personalInfo.tiktok || '',

  // Fichiers
  profile_photo: null,
  cv: null,
});

// Preview photo
const previewPhoto = ref(
  props.personalInfo.profile_photo
    ? `/storage/${props.personalInfo.profile_photo}`
    : null
);

watch(() => form.profile_photo, file => {
  if (file) previewPhoto.value = URL.createObjectURL(file);
});

function submit() {
  form.submit(props.method, props.submitUrl);
}
</script>

<template>
  <form @submit.prevent="submit" class="max-w-xl p-6 space-y-6 bg-[#0F0F2F] rounded-xl shadow-md">

    <!-- TITRE -->
    <h2 class="text-center text-2xl font-bold text-[#52c5ff] mb-4">
      Modifier mes informations
    </h2>

    <!-- IDENTITÉ : Prénom + Nom sur la même ligne -->
    <div class="flex gap-4">
      <div class="flex-1">
        <label class="block mb-1 text-[#52c5ff] font-semibold">Prénom</label>
        <input v-model="form.first_name" class="w-full input bg-[#011c2f] text-[#E0E6F0]" type="text" />
      </div>
      <div class="flex-1">
        <label class="block mb-1 text-[#52c5ff] font-semibold">Nom</label>
        <input v-model="form.last_name" class="w-full input bg-[#011c2f] text-[#E0E6F0]" type="text" />
      </div>
    </div>

    <!-- TEL + SURNOM sur la même ligne -->
    <div class="flex gap-4">
      <div class="flex-1">
        <label class="block mb-1 text-[#52c5ff] font-semibold">Surnom</label>
        <input v-model="form.nickname" class="w-full input bg-[#011c2f] text-[#E0E6F0]" type="text" />
      </div>
      <div class="flex-1">
        <label class="block mb-1 text-[#52c5ff] font-semibold">Téléphone</label>
        <input v-model="form.phone" class="w-full input bg-[#011c2f] text-[#E0E6F0]" type="text" />
      </div>
    </div>

    <!-- Email -->
    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">Email</label>
      <input v-model="form.email" type="email" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <!-- SÉPARATEUR -->
    <div class="w-full h-2 mb-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

    <!-- LOCALISATION -->
    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">Localisation</label>
      <input v-model="form.location" type="text" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <!-- MÉTIER + DISPONIBILITÉ sur la même ligne -->
    <div class="flex gap-4">
      <div class="flex-1">
        <label class="block mb-1 text-[#52c5ff] font-semibold">Métier</label>
        <input v-model="form.job_title" type="text" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
      </div>
      <div class="flex-1">
        <label class="block mb-1 text-[#52c5ff] font-semibold">Disponibilité</label>
        <input v-model="form.availability" type="text" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
      </div>
    </div>

    <!-- BIO -->
    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">Bio</label>
      <textarea v-model="form.bio" class="w-full input bg-[#011c2f] text-[#E0E6F0]" rows="4"></textarea>
    </div>

    <!-- SÉPARATEUR -->
    <div class="w-full h-2 mb-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

    <!-- RÉSEAUX SOCIAUX -->
    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">LinkedIn</label>
      <input v-model="form.linkedin" type="url" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">GitHub</label>
      <input v-model="form.github" type="url" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">Twitter</label>
      <input v-model="form.twitter" type="url" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">Facebook</label>
      <input v-model="form.facebook" type="url" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">YouTube</label>
      <input v-model="form.youtube" type="url" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <div>
      <label class="block mb-1 text-[#52c5ff] font-semibold">TikTok</label>
      <input v-model="form.tiktok" type="url" class="w-full input bg-[#011c2f] text-[#E0E6F0]" />
    </div>

    <!-- SÉPARATEUR -->
    <div class="w-full h-2 mb-4 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

    <!-- FICHIERS : Photo + CV sur la même ligne -->
    <div class="flex items-end gap-4">
      <div class="flex-1">
        <input type="file" accept="image/*" @change="e => form.profile_photo = e.target.files[0]" class="w-full cursor-pointer nav-btn" />
        <img v-if="previewPhoto" :src="previewPhoto" class="object-cover w-24 h-24 mt-2 rounded-full" />
      </div>
      <div class="flex-1">
        <input type="file" accept=".pdf,.doc,.docx" @change="e => form.cv = e.target.files[0]" class="w-full cursor-pointer nav-btn" />
        <a v-if="props.personalInfo.cv"
           :href="`/storage/${props.personalInfo.cv}`"
           target="_blank"
           class="text-blue-500 underline">
          Voir CV actuel
        </a>
      </div>
    </div>

    <!-- BOUTON ENREGISTRER -->
    <button type="submit" class="w-full mt-4 nav-btn" :disabled="form.processing">
      Enregistrer
    </button>
  </form>
</template>

<style scoped>
.input {
  padding: 0.5rem;
  border-radius: 0.5rem;
  border: none;
}

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

.nav-btn:hover {
  opacity: 1;
}
</style>
