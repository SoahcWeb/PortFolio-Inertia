<script setup>
import { Head, Link } from '@inertiajs/vue3'
import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
} from "@/components/ui/card"

const props = defineProps({
  formations: Array,
})
</script>

<template>
  <Head title="Formations" />

  <div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold">Formations</h1>
      <Link
        href="/formations/create"
        class="px-4 py-2 text-white rounded-md bg-primary hover:bg-primary/80"
      >
        + Ajouter une formation
      </Link>
    </div>

    <Card>
      <CardHeader>
        <CardTitle>Liste des formations</CardTitle>
      </CardHeader>

      <CardContent>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b">
              <th class="py-2">Diplôme</th>
              <th class="py-2">Établissement</th>
              <th class="py-2">Lieu</th>
              <th class="py-2">Dates</th>
              <th class="py-2"></th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="form in formations"
              :key="form.id"
              class="border-b hover:bg-muted/20"
            >
              <td class="py-2">{{ form.degree }}</td>
              <td>{{ form.school }}</td>
              <td>{{ form.location }}</td>
              <td>{{ form.start_date }} → {{ form.end_date }}</td>

              <td class="text-right">
                <Link
                  :href="`/formations/${form.id}/edit`"
                  class="mr-3 text-primary hover:underline"
                >
                  Modifier
                </Link>

                <Link
                  as="button"
                  method="delete"
                  :href="`/formations/${form.id}`"
                  class="text-red-600 hover:underline"
                >
                  Supprimer
                </Link>
              </td>
            </tr>

            <tr v-if="formations.length === 0">
              <td colspan="5" class="py-4 text-center text-muted-foreground">
                Aucune formation trouvée.
              </td>
            </tr>
          </tbody>
        </table>
      </CardContent>
    </Card>
  </div>
</template>
