<script setup>
import Form from './Form.vue';

const props = defineProps({
  personalInfo: Object
});
</script>

<template>
  <div class="p-6">
    <h1 class="mb-4 text-2xl font-bold">Modifier mes infos personnelles</h1>
    <Form
      :personalInfo="personalInfo"
      :submitUrl="route('admin.personal-info.update')"
      method="put"
    />
  </div>
</template>
