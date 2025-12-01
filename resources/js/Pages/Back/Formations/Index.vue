<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  formations: Object,     // Pagination Laravel + Inertia
  filters: Object         // Pour garder en mémoire le tri
});

// Gestion du tri
function sortBy(column) {
  const newDirection = props.filters.direction === 'asc' ? 'desc' : 'asc';
  router.get(route('admin.formations.index'), {
    ...props.filters,
    sort: column,
    direction: newDirection
  }, {
    preserveScroll: true,
    preserveState: true,
  });
}

// Suppression avec confirmation
function remove(id) {
  if (confirm('Voulez-vous vraiment supprimer cette formation ?')) {
    router.delete(route('admin.formations.destroy', id));
  }
}
</script>

<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Formations</h1>
      <Link
        :href="route('admin.formations.create')"
        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
      >
        + Ajouter
      </Link>
    </div>

    <!-- Tableau -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-100 border-b">
          <tr>
            <th class="p-3 cursor-pointer" @click="sortBy('title')">
              Titre
              <span v-if="filters.sort === 'title'">
                ({{ filters.direction }})
              </span>
            </th>
            <th class="p-3 cursor-pointer" @click="sortBy('school')">
              École
              <span v-if="filters.sort === 'school'">
                ({{ filters.direction }})
              </span>
            </th>
            <th class="p-3">Lieu</th>
            <th class="p-3 cursor-pointer" @click="sortBy('start_date')">
              Dates
              <span v-if="filters.sort === 'start_date'">
                ({{ filters.direction }})
              </span>
            </th>
            <th class="p-3 text-right">Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="formation in formations.data" :key="formation.id" class="border-b hover:bg-gray-50">
            <td class="p-3">{{ formation.title }}</td>
            <td class="p-3">{{ formation.school }}</td>
            <td class="p-3">{{ formation.location || '—' }}</td>
            <td class="p-3">
              {{ formation.start_date }} →
              <span v-if="formation.is_current">En cours</span>
              <span v-else>{{ formation.end_date }}</span>
            </td>
            <td class="p-3 space-x-2 text-right">
              <Link
                :href="route('admin.formations.edit', formation.id)"
                class="text-blue-600 hover:underline"
              >Modifier</Link>

              <button @click="remove(formation.id)" class="text-red-600 hover:underline">
                Supprimer
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center gap-2 mt-6">
      <Link
        v-for="link in formations.links"
        :key="link.label"
        :href="link.url || ''"
        v-html="link.label"
        class="px-3 py-1 border rounded"
        :class="{
          'bg-blue-600 text-white': link.active,
          'text-gray-700 hover:bg-gray-100': !link.active
        }"
      />
    </div>
  </div>
</template>
