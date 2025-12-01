<template>
  <div class="p-4">
    <h1 class="mb-4 text-2xl font-bold">Expériences</h1>
    <Link href="/admin/experiences/create" class="mb-4 btn btn-primary">Ajouter une expérience</Link>

    <div class="overflow-x-auto">
      <table class="w-full border border-collapse border-gray-200 table-auto">
        <thead>
          <tr class="bg-gray-100">
            <th @click="sort('title')" class="px-4 py-2 border cursor-pointer">Poste <span>{{ sortIcon('title') }}</span></th>
            <th @click="sort('company')" class="px-4 py-2 border cursor-pointer">Entreprise <span>{{ sortIcon('company') }}</span></th>
            <th @click="sort('location')" class="px-4 py-2 border cursor-pointer">Lieu <span>{{ sortIcon('location') }}</span></th>
            <th @click="sort('type')" class="px-4 py-2 border cursor-pointer">Type <span>{{ sortIcon('type') }}</span></th>
            <th @click="sort('start_date')" class="px-4 py-2 border cursor-pointer">Dates <span>{{ sortIcon('start_date') }}</span></th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="exp in experiences.data" :key="exp.id" class="hover:bg-gray-50">
            <td class="px-4 py-2 border">{{ exp.title }}</td>
            <td class="px-4 py-2 border">{{ exp.company }}</td>
            <td class="px-4 py-2 border">{{ exp.location }}</td>
            <td class="px-4 py-2 border">{{ exp.type }}</td>
            <td class="px-4 py-2 border">{{ exp.start_date }} - {{ exp.end_date || 'Présent' }}</td>
            <td class="px-4 py-2 space-x-2 border">
              <Link :href="`/admin/experiences/${exp.id}/edit`" class="btn btn-sm btn-secondary">Modifier</Link>
              <button @click="destroy(exp.id)" class="btn btn-sm btn-danger">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      <pagination :links="experiences.links" />
    </div>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ experiences: Object });

const sortField = ref('');
const sortDirection = ref('asc');

function destroy(id) {
  if (confirm('Supprimer cette expérience ?')) {
    Inertia.delete(`/admin/experiences/${id}`);
  }
}

function sort(field) {
  if (sortField.value === field) {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
  } else {
    sortField.value = field;
    sortDirection.value = 'asc';
  }

  Inertia.get(route('admin.experiences.index'), {
    sort: sortField.value,
    direction: sortDirection.value,
  }, { preserveState: true });
}

function sortIcon(field) {
  if (sortField.value !== field) return '';
  return sortDirection.value === 'asc' ? '↑' : '↓';
}
</script>
