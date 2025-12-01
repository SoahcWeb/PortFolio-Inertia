<script setup>
import Form from './Form.vue';
</script>

<template>
  <div class="p-4">
    <h1 class="mb-4 text-2xl font-bold">Créer une formation</h1>

    <!-- on passe la route de stockage et la méthode POST -->
    <Form :submitUrl="route('admin.formations.store')" method="post" />
  </div>
</template>
