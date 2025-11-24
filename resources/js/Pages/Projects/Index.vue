<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  projects: Array
});

const handleDelete = (id) => {
  if (confirm("Voulez-vous vraiment supprimer ce projet ?")) {
    Inertia.delete(`/projects/${id}`);
  }
};
</script>

<template>
  <Head title="Projects" />

  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Projets</h1>
      <Link href="/projects/create" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
        Nouveau projet
      </Link>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Titre</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Type</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Statut</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Technologies</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="project in projects" :key="project.id">
            <td class="px-6 py-4 whitespace-nowrap">{{ project.title }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ project.type }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ project.status }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span v-for="tech in project.technologies" :key="tech.id" class="inline-block px-2 py-1 mr-1 text-gray-700 bg-gray-200 rounded">
                {{ tech.name }}
              </span>
            </td>
            <td class="flex px-6 py-4 space-x-2 whitespace-nowrap">
              <Link
                :href="`/projects/${project.id}/edit`"
                class="px-2 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600"
              >
                Edit
              </Link>
              <button
                @click="handleDelete(project.id)"
                class="px-2 py-1 text-white bg-red-600 rounded hover:bg-red-700"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="projects.length === 0">
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Aucun projet trouvé</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
