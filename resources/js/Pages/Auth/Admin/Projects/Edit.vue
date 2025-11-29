<template>
  <div class="p-6">
    <h1 class="mb-4 text-2xl font-bold">Modifier le projet</h1>

    <form @submit.prevent="submit">
      <!-- Titre -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Titre</label>
        <input v-model="form.title" type="text" class="w-full p-2 border rounded" required />
      </div>

      <!-- Technologies -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Technologies</label>
        <select v-model="form.technologies" multiple class="w-full p-2 border rounded">
          <option v-for="tech in technologies" :key="tech.id" :value="tech.id">{{ tech.name }}</option>
        </select>
      </div>

      <!-- Image principale -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Image principale</label>
        <input type="file" @change="handleMainImage" />
        <div v-if="previewMainImage || project.main_image_url" class="mt-2">
          <img :src="previewMainImage || project.main_image_url" class="object-cover w-48 h-48 rounded" />
        </div>
      </div>

      <!-- Galerie -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Galerie</label>
        <input type="file" multiple @change="handleGallery" />
        <div class="flex flex-wrap gap-2 mt-2">
          <div v-for="(img, index) in galleryPreviews" :key="index" class="relative w-24 h-24">
            <img :src="img" class="object-cover w-full h-full rounded" />
            <button type="button" @click="removeGallery(index)"
              class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-white bg-red-500 rounded-full">×</button>
          </div>
        </div>
      </div>

      <!-- Description (Tiptap) -->
      <div class="mb-4">
        <label class="block mb-1 font-semibold">Description</label>
        <editor-content :editor="editor" class="border p-2 rounded min-h-[150px]" />
      </div>

      <!-- Bouton submit -->
      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Mettre à jour</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onBeforeUnmount } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import { EditorContent } from '@tiptap/vue-3';
import { usePage } from '@inertiajs/inertia-vue3';

const { props } = usePage();
const project = props.value.project;
const technologies = props.value.technologies;

const form = useForm({
  title: project.title,
  technologies: project.technologies.map(t => t.id),
  main_image: null,
  gallery: [],
  description: project.description || ''
});

const previewMainImage = ref(null);
const galleryPreviews = ref([...project.gallery_urls]);

const editor = new Editor({
  extensions: [StarterKit],
  content: form.description,
  onUpdate: ({ editor }) => {
    form.description = editor.getHTML();
  }
});

onBeforeUnmount(() => {
  editor.destroy();
});

const handleMainImage = (e) => {
  form.main_image = e.target.files[0];
  previewMainImage.value = URL.createObjectURL(form.main_image);
};

const handleGallery = (e) => {
  const files = Array.from(e.target.files);
  form.gallery.push(...files);
  galleryPreviews.value.push(...files.map(f => URL.createObjectURL(f)));
};

const removeGallery = (index) => {
  form.gallery.splice(index, 1);
  galleryPreviews.value.splice(index, 1);
};

const submit = () => {
  const data = new FormData();
  data.append('title', form.title);
  data.append('description', form.description);

  form.technologies.forEach(id => data.append('technologies[]', id));
  if (form.main_image) data.append('main_image', form.main_image);
  form.gallery.forEach(file => data.append('gallery[]', file));

  form.put(route('admin.projects.update', project.id), { data });
};
</script>
