<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ personalInfo: Object });

const form = useForm({ ...props.personalInfo, cv: null, profile_photo: null });

function submit() {
  form.put(`/personal-info/${form.id}`);
}

function handleFileUpload(event, field) {
  form[field] = event.target.files[0];
}
</script>

<template>
  <Head title="Éditer Profil" />
  <AuthenticatedLayout title="Éditer Profil">
    <form @submit.prevent="submit" class="max-w-2xl p-6 mx-auto space-y-4 bg-white rounded shadow">
      <!-- Même structure que Create.vue avec valeurs initiales -->
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
      <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Mettre à jour</button>
    </form>
  </AuthenticatedLayout>
</template>
