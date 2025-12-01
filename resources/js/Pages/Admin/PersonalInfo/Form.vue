<script setup>
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
  personalInfo: {
    type: Object,
    default: () => ({
      profile_photo: null,
      cv: null,
      linkedin: '',
      github: '',
      availability: '',
    })
  },
  submitUrl: { type: String, default: '' },
  method: { type: String, default: 'put' }
});

const form = useForm({
  profile_photo: null,
  cv: null,
  linkedin: props.personalInfo.linkedin || '',
  github: props.personalInfo.github || '',
  availability: props.personalInfo.availability || '',
});

// Prévisualisation photo
const previewPhoto = ref(props.personalInfo.profile_photo ? `/storage/${props.personalInfo.profile_photo}` : null);

// Mettre à jour preview
watch(() => form.profile_photo, file => {
  if (file) {
    previewPhoto.value = URL.createObjectURL(file);
  }
});

function submit() {
  form.submit(props.method, props.submitUrl);
}
</script>

<template>
  <form @submit.prevent="submit" class="max-w-xl p-6 space-y-4 bg-white rounded shadow">

    <!-- Photo profil -->
    <div>
      <label class="block mb-1 font-semibold">Photo de profil</label>
      <input type="file" accept="image/*" @change="e => form.profile_photo = e.target.files[0]" />
      <p v-if="form.errors.profile_photo" class="text-sm text-red-500">{{ form.errors.profile_photo }}</p>
      <img v-if="previewPhoto" :src="previewPhoto" class="object-cover w-24 h-24 mt-2 rounded-full" />
    </div>

    <!-- CV upload -->
    <div>
      <label class="block mb-1 font-semibold">CV (PDF, DOC, DOCX)</label>
      <input type="file" accept=".pdf,.doc,.docx" @change="e => form.cv = e.target.files[0]" />
      <p v-if="form.errors.cv" class="text-sm text-red-500">{{ form.errors.cv }}</p>
      <a v-if="props.personalInfo.cv" :href="`/storage/${props.personalInfo.cv}`" target="_blank" class="block mt-1 text-blue-600 underline">
        Voir CV actuel
      </a>
    </div>

    <!-- Liens sociaux -->
    <div>
      <label class="block mb-1 font-semibold">LinkedIn</label>
      <input v-model="form.linkedin" type="url" class="w-full input" placeholder="https://linkedin.com/in/username" />
      <p v-if="form.errors.linkedin" class="text-sm text-red-500">{{ form.errors.linkedin }}</p>
    </div>

    <div>
      <label class="block mb-1 font-semibold">GitHub</label>
      <input v-model="form.github" type="url" class="w-full input" placeholder="https://github.com/username" />
      <p v-if="form.errors.github" class="text-sm text-red-500">{{ form.errors.github }}</p>
    </div>

    <!-- Disponibilité -->
    <div>
      <label class="block mb-1 font-semibold">Disponibilité</label>
      <input v-model="form.availability" type="text" class="w-full input" placeholder="Ex : Disponible immédiatement" />
      <p v-if="form.errors.availability" class="text-sm text-red-500">{{ form.errors.availability }}</p>
    </div>

    <!-- Bouton -->
    <button type="submit" class="mt-4 btn-primary" :disabled="form.processing">
      Sauvegarder
    </button>
  </form>
</template>
