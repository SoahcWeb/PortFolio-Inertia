<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
  formation: {
    type: Object,
    default: () => ({
      title: "",
      school: "",
      location: "",
      start_date: "",
      end_date: "",
      is_current: false,
      description: "",
      logo: null,
    })
  },
  submitUrl: { type: String, default: '' },
  method: { type: String, default: "post" }
});

const form = useForm({
  title: props.formation.title || '',
  school: props.formation.school || '',
  location: props.formation.location || '',
  start_date: props.formation.start_date || '',
  end_date: props.formation.end_date || '',
  is_current: props.formation.is_current || false,
  description: props.formation.description || '',
  logo: null,
});

const preview = ref(props.formation.logo || null);

// Reset end_date si "en cours"
watch(() => form.is_current, val => {
  if (val) form.end_date = null;
});

// Preview du logo
function handleFile(e) {
  form.logo = e.target.files[0];
  if (form.logo) {
    preview.value = URL.createObjectURL(form.logo);
  }
}

function submit() {
  form.submit(props.method, props.submitUrl, {
    preserveScroll: true,
    onSuccess: () => {
      // Reset form si nécessaire
    }
  });
}
</script>

<template>
  <form @submit.prevent="submit" class="max-w-xl p-6 space-y-4 bg-white rounded-lg shadow">
    <!-- Titre -->
    <div>
      <label class="block mb-1 font-semibold">Titre</label>
      <input v-model="form.title" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <p v-if="form.errors.title" class="mt-1 text-sm text-red-500">{{ form.errors.title }}</p>
    </div>

    <!-- École -->
    <div>
      <label class="block mb-1 font-semibold">École</label>
      <input v-model="form.school" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
      <p v-if="form.errors.school" class="mt-1 text-sm text-red-500">{{ form.errors.school }}</p>
    </div>

    <!-- Lieu -->
    <div>
      <label class="block mb-1 font-semibold">Lieu</label>
      <input v-model="form.location" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    <!-- Dates -->
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block mb-1 font-semibold">Date début</label>
        <input type="date" v-model="form.start_date" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>
      <div>
        <label class="block mb-1 font-semibold">Date fin</label>
        <input type="date" v-model="form.end_date" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" :disabled="form.is_current" />
      </div>
    </div>

    <div class="flex items-center gap-2">
      <input type="checkbox" v-model="form.is_current" class="w-4 h-4" />
      <label>En cours</label>
    </div>

    <!-- Description -->
    <div>
      <label class="block mb-1 font-semibold">Description</label>
      <textarea v-model="form.description" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <!-- Logo upload + preview -->
    <div>
      <label class="block mb-1 font-semibold">Logo</label>
      <input type="file" accept="image/*" @change="handleFile" class="w-full mb-2" />
      <p v-if="form.errors.logo" class="mt-1 text-sm text-red-500">{{ form.errors.logo }}</p>

      <div v-if="preview" class="mt-2">
        <p class="mb-1 font-semibold">Preview :</p>
        <img :src="preview" alt="Logo preview" class="object-contain h-20 p-1 border rounded" />
      </div>
    </div>

    <!-- Submit -->
    <button type="submit" class="px-4 py-2 mt-4 text-white bg-blue-600 rounded hover:bg-blue-700" :disabled="form.processing">
      {{ props.method === 'post' ? 'Créer' : 'Mettre à jour' }}
    </button>
  </form>
</template>
