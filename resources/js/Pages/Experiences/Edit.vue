<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ experience: Object });

const form = useForm({ ...props.experience });

function submit() {
  form.put(`/experiences/${form.id}`);
}
</script>

<template>
  <Head title="Éditer expérience" />
  <AuthenticatedLayout title="Éditer expérience">
    <form @submit.prevent="submit" class="max-w-xl p-6 mx-auto space-y-4 bg-white rounded shadow">
      <div>
        <label class="block font-semibold">Poste</label>
        <input v-model="form.position" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div>
        <label class="block font-semibold">Entreprise</label>
        <input v-model="form.company" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div>
        <label class="block font-semibold">Lieu</label>
        <input v-model="form.location" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div class="flex space-x-2">
        <div class="flex-1">
          <label class="block font-semibold">Date début</label>
          <input v-model="form.start_date" type="date" class="w-full p-2 mt-1 border rounded" />
        </div>
        <div class="flex-1">
          <label class="block font-semibold">Date fin</label>
          <input v-model="form.end_date" type="date" class="w-full p-2 mt-1 border rounded" />
        </div>
      </div>
      <div>
        <label class="block font-semibold">Type</label>
        <select v-model="form.type" class="w-full p-2 mt-1 border rounded">
          <option value="">Sélectionner</option>
          <option>Stage</option>
          <option>CDI</option>
          <option>CDD</option>
          <option>Freelance</option>
          <option>Alternance</option>
        </select>
      </div>
      <div>
        <label class="block font-semibold">Description</label>
        <textarea v-model="form.description" class="w-full p-2 mt-1 border rounded"></textarea>
      </div>
      <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Mettre à jour</button>
    </form>
  </AuthenticatedLayout>
</template>
