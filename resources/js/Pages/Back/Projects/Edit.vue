<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    project: Object,
    technologies: Array
});

const form = useForm({
    title: props.project.title || '',
    description: props.project.description || '',
    main_image: null,
    gallery: [],                // nouvelles images
    technologies: props.project.technologies?.map(t => t.id) || [],
    remove_gallery: []          // images à supprimer
});

// Soumission du formulaire
function submit() {
    const data = new FormData();
    data.append('title', form.title);
    data.append('description', form.description);
    if (form.main_image) data.append('main_image', form.main_image);
    form.gallery.forEach(file => data.append('gallery[]', file));
    form.technologies.forEach(t => data.append('technologies[]', t));
    form.remove_gallery.forEach(url => data.append('remove_gallery[]', url));

    Inertia.post(route('admin.projects.update', props.project.id), data, { method: 'put' });
}

// Gestion fichiers
function handleMainImageChange(e) {
    form.main_image = e.target.files[0];
}

function handleGalleryChange(e) {
    form.gallery = Array.from(e.target.files);
}

// Supprimer une image existante
function removeExistingImage(url) {
    if (!form.remove_gallery.includes(url)) {
        form.remove_gallery.push(url);
    }
}
</script>

<template>
  <Head title="Éditer projet" />

  <div class="max-w-3xl p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Éditer projet</h1>

    <form @submit.prevent="submit" class="space-y-4">

      <!-- Titre -->
      <div>
        <label class="block mb-1">Titre</label>
        <input v-model="form.title" type="text" class="w-full px-2 py-1 border rounded" required />
      </div>

      <!-- Description -->
      <div>
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="w-full px-2 py-1 border rounded"></textarea>
      </div>

      <!-- Image principale -->
      <div>
        <label class="block mb-1">Image principale</label>
        <input type="file" @change="handleMainImageChange" />
        <div v-if="project.main_image" class="mt-2">
          <img :src="`/storage/${project.main_image}`" alt="Main image" class="object-cover w-32 h-32 border" />
        </div>
      </div>

      <!-- Galerie -->
      <div>
        <label class="block mb-1">Galerie</label>
        <input type="file" multiple @change="handleGalleryChange" />
        <div class="flex flex-wrap gap-2 mt-2">
          <div v-for="(img, index) in project.gallery" :key="index" class="relative">
            <img :src="`/storage/${img}`" class="object-cover w-24 h-24 border" />
            <button type="button" @click="removeExistingImage(img)"
              class="absolute top-0 right-0 px-1 text-white bg-red-600 rounded-full hover:bg-red-700">
              ×
            </button>
          </div>
        </div>
      </div>

      <!-- Technologies -->
      <div>
        <label class="block mb-1">Technologies</label>
        <select v-model="form.technologies" multiple class="w-full px-2 py-1 border rounded">
          <option v-for="tech in technologies" :key="tech.id" :value="tech.id">{{ tech.name }}</option>
        </select>
      </div>

      <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
        Mettre à jour
      </button>
    </form>
  </div>
</template>
