<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  technology: Object
});

const form = ref({
  name: props.technology.name,
  category: props.technology.category,
  level: props.technology.level,
  color: props.technology.color || '#000000',
  order: props.technology.order || 1,
  logo: null
});

function submit() {
  const data = new FormData();
  Object.entries(form.value).forEach(([key, value]) => {
    if (value !== null) data.append(key, value);
  });

  data.append('_method', 'PATCH');

  Inertia.post(`/technologies/${props.technology.id}`, data);
}
</script>

<template>
  <Head title="Modifier Technologie" />

  <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-6 text-2xl font-bold">Modifier Technologie</h1>

    <div class="space-y-4">
      <div>
        <label class="block font-medium">Nom</label>
        <input v-model="form.name" type="text" class="block w-full p-2 mt-1 border rounded" />
      </div>

      <div>
        <label class="block font-medium">Catégorie</label>
        <select v-model="form.category" class="block w-full p-2 mt-1 border rounded">
          <option>Backend</option>
          <option>Frontend</option>
          <option>BDD</option>
          <option>DevOps</option>
          <option>Design</option>
        </select>
      </div>

      <div>
        <label class="block font-medium">Niveau</label>
        <select v-model="form.level" class="block w-full p-2 mt-1 border rounded">
          <option>Débutant</option>
          <option>Intermédiaire</option>
          <option>Avancé</option>
          <option>Expert</option>
        </select>
      </div>

      <div>
        <label class="block font-medium">Couleur</label>
        <input v-model="form.color" type="color" class="w-16 h-10 p-1 mt-1 border rounded" />
      </div>

      <div>
        <label class="block font-medium">Ordre</label>
        <input v-model="form.order" type="number" class="block w-full p-2 mt-1 border rounded" />
      </div>

      <div>
        <label class="block font-medium">Logo</label>
        <input @change="e => form.logo = e.target.files[0]" type="file" class="mt-1" />
        <img v-if="props.technology.logo" :src="`/storage/${props.technology.logo}`" class="w-20 h-20 mt-2" />
      </div>
    </div>

    <div class="flex justify-between mt-6">
      <Link href="/technologies" class="px-4 py-2 border rounded hover:bg-gray-100">Annuler</Link>
      <button @click="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Enregistrer</button>
    </div>
  </div>
</template>
