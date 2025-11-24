<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const form = ref({
  title: '',
  slug: '',
  description_short: '',
  description: '',
  type: 'Site web',
  status: 'Brouillon',
  date: '',
  client: '',
  context: '',
  duration: '',
  role: '',
  link_project: '',
  link_github: '',
  order: 1,
  main_image: null,
  technologies: [],
});

const technologies = $page.props.technologies || [];

const handleSubmit = () => {
  const data = new FormData();
  for (const key in form.value) {
    if (key === 'technologies') {
      form.value.technologies.forEach(id => data.append('technologies[]', id));
    } else {
      data.append(key, form.value[key]);
    }
  }
  Inertia.post('/projects', data);
};
</script>

<template>
  <Head title="Create Project" />
  <h1 class="mb-4 text-2xl font-bold">Créer un projet</h1>

  <form @submit.prevent="handleSubmit" class="space-y-4">
    <input v-model="form.title" type="text" placeholder="Titre" class="w-full p-2 border rounded" />
    <input v-model="form.slug" type="text" placeholder="Slug" class="w-full p-2 border rounded" />
    <textarea v-model="form.description_short" placeholder="Description courte" class="w-full p-2 border rounded"></textarea>
    <textarea v-model="form.description" placeholder="Description détaillée" class="w-full p-2 border rounded"></textarea>

    <select v-model="form.type" class="w-full p-2 border rounded">
      <option>Site web</option>
      <option>App mobile</option>
      <option>API</option>
      <option>Design</option>
    </select>

    <select v-model="form.status" class="w-full p-2 border rounded">
      <option>Brouillon</option>
      <option>Publié</option>
      <option>Archivé</option>
    </select>

    <input v-model="form.main_image" type="file" @change="e => form.main_image = e.target.files[0]" />

    <div>
      <h3>Technologies</h3>
      <div v-for="tech in technologies" :key="tech.id">
        <label>
          <input type="checkbox" :value="tech.id" v-model="form.technologies" /> {{ tech.name }}
        </label>
      </div>
    </div>

    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Créer</button>
    <Link href="/projects" class="ml-4 text-blue-500">Annuler</Link>
  </form>
</template>
