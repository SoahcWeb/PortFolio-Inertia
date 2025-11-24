<template>
  <div>
    <h1 class="mb-4 text-2xl font-bold">Ajouter une technologie</h1>

    <form @submit.prevent="submit" enctype="multipart/form-data">
      <div class="mb-2">
        <label>Nom</label>
        <input v-model="form.name" type="text" class="input" />
      </div>

      <div class="mb-2">
        <label>Catégorie</label>
        <select v-model="form.category" class="input">
          <option>Backend</option>
          <option>Frontend</option>
          <option>BDD</option>
          <option>DevOps</option>
          <option>Design</option>
        </select>
      </div>

      <div class="mb-2">
        <label>Niveau</label>
        <select v-model="form.level" class="input">
          <option>Débutant</option>
          <option>Intermédiaire</option>
          <option>Avancé</option>
          <option>Expert</option>
        </select>
      </div>

      <div class="mb-2">
        <label>Couleur</label>
        <input type="color" v-model="form.color" class="w-16 h-8 p-0 input" />
      </div>

      <div class="mb-2">
        <label>Ordre</label>
        <input v-model="form.order" type="number" class="w-20 input" min="0" />
      </div>

      <div class="mb-2">
        <label>Logo</label>
        <input type="file" @change="handleFile" />
      </div>

      <button type="submit" class="mt-2 btn-primary">Créer</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const form = ref({
  name: '',
  category: 'Backend',
  level: 'Débutant',
  color: '#000000',
  order: 0,
  logo: null
})

const handleFile = (event) => {
  form.value.logo = event.target.files[0]
}

const submit = () => {
  const data = new FormData()
  for (const key in form.value) {
    data.append(key, form.value[key])
  }
  Inertia.post('/technologies', data)
}
</script>
