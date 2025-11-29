<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Props
const props = defineProps({
  technologies: Array
});

// Formulaire
const form = ref({
  title: '',
  slug: '',
  description_short: '',
  description: '',
  type: 'Site web',
  status: 'Brouillon',
  date: '',
  client: '',
  context: '',
  duration: '',
  role: '',
  link_project: '',
  link_github: '',
  order: 1,
  main_image: null,
  technologies: [],
});

// Soumission
const handleSubmit = () => {
  const data = new FormData();
  for (const key in form.value) {
    if (key === 'technologies') {
      form.value.technologies.forEach(id => data.append('technologies[]', id));
    } else if (key === 'main_image' && form.value.main_image) {
      data.append('main_image', form.value.main_image);
    } else {
      data.append(key, form.value[key]);
    }
  }
  Inertia.post('/admin/projects', data); // route store
};

// Gestion fichier
const handleMainImageChange = (e) => {
  form.value.main_image = e.target.files[0];
};
</script>

<template>
  <AuthenticatedLayout title="Créer un projet">
    <Head title="Créer un projet" />

    <div class="max-w-3xl p-6 mx-auto">
      <h1 class="mb-6 text-2xl font-bold">Créer un projet</h1>

      <form @submit.prevent="handleSubmit" class="space-y-4">
        <input v-model="form.title" type="text" placeholder="Titre" class="w-full p-2 border rounded" required />
        <input v-model="form.slug" type="text" placeholder="Slug" class="w-full p-2 border rounded" />
        <textarea v-model="form.description_short" placeholder="Description courte" class="w-full p-2 border rounded"></textarea>
        <textarea v-model="form.description" placeholder="Description détaillée" class="w-full p-2 border rounded"></textarea>

        <select v-model="form.type" class="w-full p-2 border rounded">
          <option>Site web</option>
          <option>App mobile</option>
          <option>API</option>
          <option>Design</option>
        </select>

        <select v-model="form.status" class="w-full p-2 border rounded">
          <option>Brouillon</option>
          <option>Publié</option>
          <option>Archivé</option>
        </select>

        <input type="file" @change="handleMainImageChange" />

        <div>
          <h3 class="mb-2 font-semibold">Technologies</h3>
          <div v-for="tech in technologies" :key="tech.id" class="mb-1">
            <label class="inline-flex items-center">
              <input type="checkbox" :value="tech.id" v-model="form.technologies" class="mr-2" />
              {{ tech.name }}
            </label>
          </div>
        </div>

        <div class="flex items-center mt-4">
          <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Créer
          </button>
          <Link href="/admin/projects" class="ml-4 text-blue-500 hover:underline">Annuler</Link>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
