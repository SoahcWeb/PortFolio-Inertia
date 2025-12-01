<template>
  <form @submit.prevent="submit" class="p-6 space-y-4 bg-white rounded shadow-md">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
      <div>
        <label class="block mb-1 font-semibold">Poste</label>
        <input v-model="form.title" type="text" required class="w-full input" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Entreprise</label>
        <input v-model="form.company" type="text" required class="w-full input" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Lieu</label>
        <input v-model="form.location" type="text" class="w-full input" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Type</label>
        <input v-model="form.type" type="text" class="w-full input" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Date début</label>
        <input v-model="form.start_date" type="date" required class="w-full input" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Date fin</label>
        <input v-model="form.end_date" type="date" class="w-full input" />
      </div>
    </div>

    <div>
      <label class="block mb-1 font-semibold">Description</label>
      <textarea v-model="form.description" class="w-full resize-none input" rows="4"></textarea>
    </div>

    <button type="submit" class="w-full btn btn-primary md:w-auto">
      {{ experience ? 'Mettre à jour' : 'Créer' }}
    </button>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  experience: Object,
});

const form = useForm({
  title: props.experience?.title || '',
  company: props.experience?.company || '',
  location: props.experience?.location || '',
  type: props.experience?.type || '',
  start_date: props.experience?.start_date || '',
  end_date: props.experience?.end_date || '',
  description: props.experience?.description || '',
});

function submit() {
  if (props.experience) {
    form.put(route('admin.experiences.update', props.experience.id));
  } else {
    form.post(route('admin.experiences.store'));
  }
}
</script>
