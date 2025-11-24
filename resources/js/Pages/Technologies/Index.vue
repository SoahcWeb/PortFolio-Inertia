<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  technologies: Array
});

function destroy(id) {
  if (confirm('Voulez-vous vraiment supprimer cette technologie ?')) {
    Inertia.delete(`/technologies/${id}`);
  }
}
</script>

<template>
  <Head title="Technologies" />
  <AuthenticatedLayout title="Technologies">
    <div class="flex justify-between mb-4">
      <h2 class="text-xl font-bold">Liste des Technologies</h2>
      <Link href="/technologies/create" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Créer</Link>
    </div>

    <table class="min-w-full bg-white rounded shadow">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-2 text-left">Nom</th>
          <th class="p-2 text-left">Catégorie</th>
          <th class="p-2 text-left">Niveau</th>
          <th class="p-2 text-left">Couleur</th>
          <th class="p-2 text-left">Ordre</th>
          <th class="p-2 text-left">Logo</th>
          <th class="p-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tech in props.technologies" :key="tech.id" class="border-b">
          <td class="p-2">{{ tech.name }}</td>
          <td class="p-2">{{ tech.category }}</td>
          <td class="p-2">{{ tech.level }}</td>
          <td class="p-2">
            <span :style="{ backgroundColor: tech.color }" class="inline-block w-6 h-6 rounded-full"></span>
          </td>
          <td class="p-2">{{ tech.order }}</td>
          <td class="p-2">
            <img v-if="tech.logo" :src="`/storage/${tech.logo}`" class="w-10 h-10" />
          </td>
          <td class="p-2 space-x-2">
            <Link :href="`/technologies/${tech.id}/edit`" class="text-green-600 hover:underline">Éditer</Link>
            <button @click="destroy(tech.id)" class="text-red-600 hover:underline">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </AuthenticatedLayout>
</template>
