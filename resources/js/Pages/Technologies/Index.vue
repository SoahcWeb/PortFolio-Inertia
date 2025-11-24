<template>
  <div>
    <h1 class="mb-4 text-2xl font-bold">Technologies</h1>

    <Link href="/technologies/create" class="mb-4 btn-primary">Ajouter une technologie</Link>

    <table class="w-full border border-collapse border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="px-4 py-2 border">Nom</th>
          <th class="px-4 py-2 border">Catégorie</th>
          <th class="px-4 py-2 border">Niveau</th>
          <th class="px-4 py-2 border">Couleur</th>
          <th class="px-4 py-2 border">Ordre</th>
          <th class="px-4 py-2 border">Logo</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tech in technologies" :key="tech.id" class="hover:bg-gray-50">
          <td class="px-4 py-2 border">{{ tech.name }}</td>
          <td class="px-4 py-2 border">{{ tech.category }}</td>
          <td class="px-4 py-2 border">{{ tech.level }}</td>
          <td class="px-4 py-2 border">
            <div :style="{ backgroundColor: tech.color }" class="w-6 h-6 rounded"></div>
          </td>
          <td class="px-4 py-2 border">{{ tech.order }}</td>
          <td class="px-4 py-2 border">
            <img v-if="tech.logo_url" :src="tech.logo_url" class="object-contain w-10 h-10" />
          </td>
          <td class="px-4 py-2 space-x-2 border">
            <Link :href="`/technologies/${tech.id}/edit`" class="btn-secondary">Éditer</Link>
            <button @click="destroy(tech.id)" class="btn-danger">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
  technologies: Array
})

const destroy = (id) => {
  if (confirm('Voulez-vous vraiment supprimer cette technologie ?')) {
    Inertia.delete(`/technologies/${id}`)
  }
}
</script>
