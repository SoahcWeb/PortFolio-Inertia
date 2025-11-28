<template>
  <div class="p-6">
    <h1 class="mb-4 text-2xl font-bold">Projets</h1>

    <!-- Barre de recherche et filtre -->
    <div class="flex mb-4 space-x-4">
      <input
        v-model="filters.search"
        type="text"
        placeholder="Rechercher un projet..."
        class="flex-1 p-2 border rounded"
      />

      <select v-model="filters.technology" class="p-2 border rounded">
        <option value="">Toutes les technologies</option>
        <option v-for="tech in technologies" :key="tech.id" :value="tech.id">
          {{ tech.name }}
        </option>
      </select>

      <button @click="resetFilters" class="px-4 bg-gray-200 rounded">Réinitialiser</button>
    </div>

    <!-- Bouton création -->
    <div class="mb-4">
      <inertia-link
        :href="route('admin.projects.create')"
        class="px-4 py-2 text-white bg-blue-500 rounded"
      >
        + Ajouter un projet
      </inertia-link>
    </div>

    <!-- Liste des projets -->
    <div v-for="project in filteredProjects" :key="project.id" class="p-4 mb-4 border rounded">
      <div class="flex items-center justify-between mb-2">
        <h2 class="text-lg font-semibold">{{ project.title }}</h2>
        <div class="space-x-2">
          <inertia-link
            :href="route('admin.projects.edit', project.id)"
            class="px-2 py-1 bg-yellow-400 rounded"
          >Éditer</inertia-link>

          <button @click="destroy(project.id)" class="px-2 py-1 text-white bg-red-500 rounded">
            Supprimer
          </button>
        </div>
      </div>

      <!-- Technologies -->
      <div class="mb-2">
        <span
          v-for="tech in project.technologies"
          :key="tech.id"
          class="px-2 py-1 mr-1 bg-gray-200 rounded"
        >
          {{ tech.name }}
        </span>
      </div>

      <!-- Galerie (drag & drop + suppression inline AJAX) -->
      <div
        class="flex flex-wrap gap-2 p-2 border rounded"
        @dragover.prevent
        @drop.prevent="handleDrop($event, project.id)"
      >
        <div
          v-for="(img, index) in projectGallery[project.id] || []"
          :key="index"
          class="relative w-24 h-24"
        >
          <img :src="img" class="object-cover w-full h-full rounded" />
          <button
            type="button"
            @click="removeGalleryImage(project.id, index)"
            class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-white bg-red-500 rounded-full"
          >
            ×
          </button>
        </div>

        <input type="file" multiple @change="addGalleryImages($event, project.id)" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import axios from 'axios';

const { props } = usePage();

const projects = ref(props.value.projects);
const technologies = ref(props.value.technologies);

const filters = ref({
  search: '',
  technology: ''
});

const filteredProjects = computed(() => {
  return projects.value.filter(p => {
    const matchSearch = filters.value.search
      ? p.title.toLowerCase().includes(filters.value.search.toLowerCase())
      : true;
    const matchTech = filters.value.technology
      ? p.technologies.some(t => t.id == filters.value.technology)
      : true;
    return matchSearch && matchTech;
  });
});

const resetFilters = () => {
  filters.value.search = '';
  filters.value.technology = '';
};

// Galerie dynamique pour chaque projet
const projectGallery = reactive({});
projects.value.forEach(p => {
  projectGallery[p.id] = [...p.gallery_urls];
});

// Ajouter des images via input (AJAX)
const addGalleryImages = async (e, projectId) => {
  const files = Array.from(e.target.files);
  const formData = new FormData();
  files.forEach(f => formData.append('gallery[]', f));

  try {
    const res = await axios.post(route('admin.projects.addGallery', projectId), formData);
    projectGallery[projectId] = res.data.gallery;
  } catch (err) {
    console.error(err);
    alert('Erreur lors de l’ajout des images');
  }
};

// Drag & drop
const handleDrop = async (e, projectId) => {
  const files = Array.from(e.dataTransfer.files);
  const formData = new FormData();
  files.forEach(f => formData.append('gallery[]', f));

  try {
    const res = await axios.post(route('admin.projects.addGallery', projectId), formData);
    projectGallery[projectId] = res.data.gallery;
  } catch (err) {
    console.error(err);
    alert('Erreur lors de l’ajout des images');
  }
};

// Supprimer image (AJAX)
const removeGalleryImage = async (projectId, index) => {
  try {
    const res = await axios.delete(route('admin.projects.removeGallery', projectId), { data: { index } });
    projectGallery[projectId] = res.data.gallery;
  } catch (err) {
    console.error(err);
    alert('Erreur lors de la suppression de l’image');
  }
};

// Supprimer projet
const destroy = (id) => {
  if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
    Inertia.delete(route('admin.projects.destroy', id));
  }
};
</script>
