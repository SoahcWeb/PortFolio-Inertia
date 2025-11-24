<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  project: Object,
  technologies: Array
});

const form = ref({
  title: props.project.title,
  slug: props.project.slug,
  description_short: props.project.description_short,
  description: props.project.description,
  type: props.project.type,
  status: props.project.status,
  date: props.project.date,
  client: props.project.client,
  context: props.project.context,
  duration: props.project.duration,
  role: props.project.role,
  link_project: props.project.link_project,
  link_github: props.project.link_github,
  order: props.project.order,
  main_image: null,
  technologies: props.project.technologies.map(t => t.id),
});

const handleSubmit = () => {
  const data = new FormData();
  for (const key in form.value) {
    if (key === 'technologies') {
      form.value.technologies.forEach(id => data.append('technologies[]', id));
    } else {
      data.append(key, form.value[key]);
    }
  }
  Inertia.post(`/projects/${props.project.id}`, data, { method: 'put' });
};
</script>

<template>
  <Head title="Edit Project" />
  <h1 class="mb-4 text-2xl font-bold">Modifier un projet</h1>

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

    <div>
      <label>Main Image</label>
      <input type="file" @change="e => form.main_image = e.target.files[0]" />
      <div v-if="props.project.main_image">
        <img :src="`/storage/${props.project.main_image}`" alt="Current image" class="object-cover w-32 h-32 mt-2 rounded" />
      </div>
    </div>

    <div>
      <h3>Technologies</h3>
      <div v-for="tech in technologies" :key="tech.id">
        <label>
          <input type="checkbox" :value="tech.id" v-model="form.technologies" /> {{ tech.name }}
        </label>
      </div>
    </div>

    <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded">Mettre à jour</button>
    <Link href="/projects" class="ml-4 text-blue-500">Annuler</Link>
  </form>
</template>
