<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    personalInfo: { type: Object, required: true },
    submitUrl: { type: String, default: '' },
    method: { type: String, default: 'put' },
});

// On initialise le form avec les vraies valeurs de la DB
const form = useForm({
    full_name: props.personalInfo.full_name || "",
    job_title: props.personalInfo.job_title || "",
    bio: props.personalInfo.bio || "",
    email: props.personalInfo.email || "",
    phone: props.personalInfo.phone || "",
    location: props.personalInfo.location || "",
    profile_photo: null,
    cv: null,
    linkedin: props.personalInfo.linkedin || "",
    github: props.personalInfo.github || "",
    twitter: props.personalInfo.twitter || "",
    availability: props.personalInfo.availability || "",
});

// Prévisualisation de la photo
const previewPhoto = ref(props.personalInfo.profile_photo ? `/storage/${props.personalInfo.profile_photo}` : null);

watch(() => form.profile_photo, file => {
    if (file) previewPhoto.value = URL.createObjectURL(file);
});

// Submit
const submit = () => {
    // On supprime la valeur par défaut "Utilisateur" si elle n'a pas été modifiée
    if (form.full_name === "Utilisateur" && props.personalInfo.full_name !== "Utilisateur") {
        form.full_name = props.personalInfo.full_name;
    }

    form.submit(props.method, props.submitUrl, {
        forceFormData: true,
        onSuccess: () => {
            Object.assign(props.personalInfo, form); // met à jour la carte réactive
        },
    });
};
</script>

<template>
<form @submit.prevent="submit" class="p-6 space-y-6 bg-[#0F0F2F]/80 rounded-xl shadow-md border border-[#0F0F2F]/50">
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Nom complet</label>
        <input v-model="form.full_name" type="text" class="input" />
    </div>
    <!-- Reste des champs identiques, inchangés -->
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Titre du poste</label>
        <input v-model="form.job_title" type="text" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Bio</label>
        <textarea v-model="form.bio" class="input h-28"></textarea>
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Email</label>
        <input v-model="form.email" type="email" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Téléphone</label>
        <input v-model="form.phone" type="text" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Localisation</label>
        <input v-model="form.location" type="text" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Photo de profil</label>
        <input type="file" @change="e => form.profile_photo = e.target.files[0]" class="input" />
        <img v-if="previewPhoto" :src="previewPhoto" class="object-cover w-24 h-24 mt-2 rounded-full" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">CV (PDF, DOC)</label>
        <input type="file" @change="e => form.cv = e.target.files[0]" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">LinkedIn</label>
        <input v-model="form.linkedin" type="url" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">GitHub</label>
        <input v-model="form.github" type="url" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Twitter</label>
        <input v-model="form.twitter" type="url" class="input" />
    </div>
    <div>
        <label class="block mb-1 text-sm font-medium text-[#52c5ff]">Disponibilité</label>
        <input v-model="form.availability" type="text" class="input" />
    </div>
    <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700" :disabled="form.processing">
        Enregistrer
    </button>
</form>
</template>

<style scoped>
.input {
    @apply w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500;
}
</style>
