<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    technologies: Array
});

// Formulaire
const form = useForm({
    title: '',
    description: '',
    main_image: null,
    gallery: [],       // nouvelles images
    technologies: []
});

// Soumission du formulaire
function submit() {
    const data = new FormData();
    data.append('title', form.title);
    data.append('description', form.description);

    if (form.main_image) data.append('main_image', form.main_image);

    // Images galerie
    form.gallery.forEach(file => data.append('gallery[]', file));

    // Technologies
    form.technologies.forEach(t => data.append('technologies[]', t));

    Inertia.post(route('admin.projects.store'), data);
}

// Gestion image principale
function handleMainImageChange(e) {
    form.main_image = e.target.files[0];
}

// Gestion galerie
function handleGalleryChange(e) {
    form.gallery = Array.from(e.target.files);
}
</script>

<template>
  <Head title="Créer un projet" />

  <div class="max-w-3xl p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Créer un projet</h1>

    <form @submit.prevent="submit" class="space-y-4">

      <div>
        <label class="block mb-1">Titre</label>
        <input v-model="form.title" type="text" class="w-full px-2 py-1 border rounded" required />
      </div>

      <div>
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="w-full px-2 py-1 border rounded"></textarea>
      </div>

      <div>
        <label class="block mb-1">Image principale</label>
        <input type="file" @change="handleMainImageChange" />
      </div>

      <div>
        <label class="block mb-1">Galerie</label>
        <input type="file" multiple @change="handleGalleryChange" />
      </div>

      <div>
        <label class="block mb-1">Technologies</label>
        <select v-model="form.technologies" multiple class="w-full px-2 py-1 border rounded">
          <option v-for="tech in technologies" :key="tech.id" :value="tech.id">{{ tech.name }}</option>
        </select>
      </div>

      <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Créer</button>
    </form>
  </div>
</template>
