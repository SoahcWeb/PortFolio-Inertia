<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    projects: Object, // paginé
    technologies: Array,
});

const search = ref('');
const technologyFilter = ref('');

// Filtrage
function filterProjects() {
    Inertia.get(route('admin.projects.index'),
        { search: search.value, technology: technologyFilter.value },
        { preserveState: true, replace: true }
    );
}

// Supprimer projet
function deleteProject(id) {
    if (confirm('Voulez-vous vraiment supprimer ce projet ?')) {
        Inertia.delete(route('admin.projects.destroy', id), { preserveState: true });
    }
}

// Pagination : construire un tableau de pages visibles (ex : 5 pages autour de la page actuelle)
const visiblePages = computed(() => {
    const total = props.projects.last_page;
    const current = props.projects.current_page;
    const delta = 2; // nombre de pages avant/après la page actuelle
    let start = Math.max(current - delta, 1);
    let end = Math.min(current + delta, total);

    const pages = [];
    for (let i = start; i <= end; i++) {
        pages.push(i);
    }
    return pages;
});

// Aller à une page
function goToPage(page) {
    Inertia.get(route('admin.projects.index'),
        { page, search: search.value, technology: technologyFilter.value },
        { preserveState: true }
    );
}
</script>

<template>
  <Head title="Projets" />

  <div class="p-6">
    <div class="flex justify-between mb-4">
      <h1 class="text-2xl font-bold">Projets</h1>
      <Link href="/admin/projects/create" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Créer un projet</Link>
    </div>

    <div class="flex gap-4 mb-4">
      <input v-model="search" @input="filterProjects" type="text" placeholder="Rechercher..." class="px-2 py-1 border rounded" />
      <select v-model="technologyFilter" @change="filterProjects" class="px-2 py-1 border rounded">
        <option value="">Toutes les technologies</option>
        <option v-for="tech in technologies" :key="tech.id" :value="tech.id">{{ tech.name }}</option>
      </select>
    </div>

    <table class="w-full border table-auto">
      <thead>
        <tr class="bg-gray-100">
          <th class="px-4 py-2">Titre</th>
          <th class="px-4 py-2">Technologies</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="project in projects.data" :key="project.id" class="border-t">
          <td class="px-4 py-2">{{ project.title }}</td>
          <td class="px-4 py-2">
            <span v-for="tech in project.technologies" :key="tech.id" class="inline-block px-2 py-1 mr-1 text-sm text-white bg-gray-600 rounded">
              {{ tech.name }}
            </span>
          </td>
          <td class="px-4 py-2">
            <Link :href="route('admin.projects.edit', project.id)" class="px-2 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">Éditer</Link>
            <button @click="deleteProject(project.id)" class="px-2 py-1 text-white bg-red-600 rounded hover:bg-red-700">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination améliorée -->
    <div class="flex justify-center mt-6 space-x-1">
      <button
        @click="goToPage(props.projects.current_page - 1)"
        :disabled="props.projects.current_page === 1"
        class="px-3 py-1 border rounded hover:bg-gray-200 disabled:opacity-50"
      >
        Précédent
      </button>

      <button
        v-for="page in visiblePages"
        :key="page"
        @click="goToPage(page)"
        class="px-3 py-1 border rounded hover:bg-gray-200"
        :class="{'bg-gray-300 font-bold': page === props.projects.current_page}"
      >
        {{ page }}
      </button>

      <button
        @click="goToPage(props.projects.current_page + 1)"
        :disabled="props.projects.current_page === props.projects.last_page"
        class="px-3 py-1 border rounded hover:bg-gray-200 disabled:opacity-50"
      >
        Suivant
      </button>
    </div>
  </div>
</template>
