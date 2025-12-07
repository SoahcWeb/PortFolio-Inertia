<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
  personalInfo: { type: Object, default: () => ({}) },
  submitUrl: { type: String, default: '' },
  method: { type: String, default: 'put' },
});

const emit = defineEmits(['update-personal-info']);

// Formulaire avec valeurs initiales
const form = useForm({
  first_name: props.personalInfo.first_name || '',
  last_name: props.personalInfo.last_name || '',
  nickname: props.personalInfo.nickname || '',
  job_title: props.personalInfo.job_title || '',
  bio: props.personalInfo.bio || '',
  email: props.personalInfo.email || '',
  phone: props.personalInfo.phone || '',
  location: props.personalInfo.location || '',
  availability: props.personalInfo.availability || '',
  linkedin: props.personalInfo.linkedin || '',
  github: props.personalInfo.github || '',
  twitter: props.personalInfo.twitter || '',
  facebook: props.personalInfo.facebook || '',
  youtube: props.personalInfo.youtube || '',
  tiktok: props.personalInfo.tiktok || '',
  profile_photo: null,
  cv: null,
});

// Prévisualisation photo
const previewPhoto = ref(
  props.personalInfo.profile_photo
    ? `/storage/${props.personalInfo.profile_photo}`
    : '/default-avatar.png'
);

// Prévisualisation CV
const currentCV = ref(
  props.personalInfo.cv ? `/storage/${props.personalInfo.cv}` : null
);

// Mettre à jour preview photo si changement
watch(() => form.profile_photo, file => {
  if (file) {
    previewPhoto.value = URL.createObjectURL(file);
  } else {
    previewPhoto.value = props.personalInfo.profile_photo
      ? `/storage/${props.personalInfo.profile_photo}`
      : '/default-avatar.png';
  }
});

// Mettre à jour CV existant
watch(() => form.cv, file => {
  if (!file) {
    currentCV.value = props.personalInfo.cv
      ? `/storage/${props.personalInfo.cv}`
      : null;
  }
});

// Submit avec synchronisation vers Edit.vue
function submit() {
  form.submit(props.method, props.submitUrl, {
    preserveState: true,
    onSuccess: () => {
      if (form.profile_photo) previewPhoto.value = URL.createObjectURL(form.profile_photo);
      if (form.cv) currentCV.value = URL.createObjectURL(form.cv);

      // 🔹 mettre à jour Edit.vue
      emit('update-personal-info', { ...form });
    }
  });
}
</script>

<template>
  <form @submit.prevent="submit" class="max-w-5xl p-6 mx-auto space-y-6 shadow-md bg-gray-50 rounded-xl">

    <h2 class="text-2xl font-bold text-gray-800">Informations personnelles</h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Prénom</label>
        <input v-model="form.first_name" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Nom</label>
        <input v-model="form.last_name" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Surnom</label>
        <input v-model="form.nickname" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Poste / Job Title</label>
        <input v-model="form.job_title" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Email</label>
        <input v-model="form.email" type="email" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Téléphone</label>
        <input v-model="form.phone" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Localisation</label>
        <input v-model="form.location" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>

      <div>
        <label class="block mb-1 font-semibold text-gray-700">Disponibilité</label>
        <input v-model="form.availability" type="text" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
    </div>

    <div>
      <label class="block mb-1 font-semibold text-gray-700">Biographie</label>
      <textarea v-model="form.bio" rows="4" class="w-full p-2 border border-gray-300 rounded-md"></textarea>
    </div>

    <h2 class="text-2xl font-bold text-gray-800">Fichiers</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

      <!-- Photo -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Photo de profil</label>
        <div class="flex items-center gap-4">
          <input type="file" accept="image/*" @change="e => form.profile_photo = e.target.files[0]" />
          <span v-if="props.personalInfo?.profile_photo" class="text-sm text-gray-500">Actuelle</span>
        </div>
        <img :src="previewPhoto" class="object-cover w-24 h-24 mt-2 rounded-full" />
      </div>

      <!-- CV -->
      <div>
        <label class="block mb-1 font-semibold text-gray-700">CV (PDF / DOCX)</label>
        <div class="flex items-center gap-4">
          <input type="file" accept=".pdf,.doc,.docx" @change="e => form.cv = e.target.files[0]" />
          <a v-if="currentCV" :href="currentCV" target="_blank" class="text-sm text-blue-600 underline">
            CV actuel
          </a>
        </div>
      </div>

    </div>

    <h2 class="text-2xl font-bold text-gray-800">Réseaux sociaux</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <div>
        <label class="block mb-1 font-semibold text-gray-700">LinkedIn</label>
        <input v-model="form.linkedin" type="url" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">GitHub</label>
        <input v-model="form.github" type="url" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Twitter</label>
        <input v-model="form.twitter" type="url" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Facebook</label>
        <input v-model="form.facebook" type="url" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">YouTube</label>
        <input v-model="form.youtube" type="url" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">TikTok</label>
        <input v-model="form.tiktok" type="url" class="w-full p-2 border border-gray-300 rounded-md" />
      </div>
    </div>

    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md shadow hover:bg-blue-700"
            :disabled="form.processing">
      Sauvegarder
    </button>

  </form>
</template>
