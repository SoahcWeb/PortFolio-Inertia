<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  name: '',
  title: '',
  bio: '',
  email: '',
  phone: '',
  location: '',
  availability: '',
  cv: null,
  profile_photo: null,
  linkedin: '',
  github: '',
  twitter: '',
});

function submit() {
  form.post('/personal-info');
}

function handleFileUpload(event, field) {
  form[field] = event.target.files[0];
}
</script>

<template>
  <Head title="Créer Profil" />
  <AuthenticatedLayout title="Créer Profil">
    <form @submit.prevent="submit" class="max-w-2xl p-6 mx-auto space-y-4 bg-white rounded shadow">
      <div>
        <label class="block font-semibold">Nom</label>
        <input v-model="form.name" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div>
        <label class="block font-semibold">Titre</label>
        <input v-model="form.title" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div>
        <label class="block font-semibold">Bio</label>
        <textarea v-model="form.bio" class="w-full p-2 mt-1 border rounded"></textarea>
      </div>
      <div class="flex space-x-2">
        <div class="flex-1">
          <label class="block font-semibold">Email</label>
          <input v-model="form.email" type="email" class="w-full p-2 mt-1 border rounded" />
        </div>
        <div class="flex-1">
          <label class="block font-semibold">Téléphone</label>
          <input v-model="form.phone" type="text" class="w-full p-2 mt-1 border rounded" />
        </div>
      </div>
      <div>
        <label class="block font-semibold">Localisation</label>
        <input v-model="form.location" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div>
        <label class="block font-semibold">Disponibilité</label>
        <input v-model="form.availability" type="text" class="w-full p-2 mt-1 border rounded" />
      </div>
      <div>
        <label class="block font-semibold">CV (PDF)</label>
        <input type="file" accept=".pdf" @change="e => handleFileUpload(e, 'cv')" />
      </div>
      <div>
        <label class="block font-semibold">Photo de profil</label>
        <input type="file" accept="image/*" @change="e => handleFileUpload(e, 'profile_photo')" />
      </div>
      <div class="flex space-x-2">
        <input v-model="form.linkedin" type="url" placeholder="LinkedIn" class="flex-1 p-2 mt-1 border rounded" />
        <input v-model="form.github" type="url" placeholder="GitHub" class="flex-1 p-2 mt-1 border rounded" />
        <input v-model="form.twitter" type="url" placeholder="Twitter" class="flex-1 p-2 mt-1 border rounded" />
      </div>
      <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Créer</button>
    </form>
  </AuthenticatedLayout>
</template>
