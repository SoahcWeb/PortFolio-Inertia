<script setup>
import { Head, Link } from '@inertiajs/vue3'
import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
} from "@/components/ui/card"

const props = defineProps({
  experiences: Array,
})
</script>

<template>
  <Head title="Experiences" />

  <div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold">Experiences</h1>
      <Link
        href="/experiences/create"
        class="px-4 py-2 text-white rounded-md bg-primary hover:bg-primary/80"
      >
        + Ajouter une expérience
      </Link>
    </div>

    <Card>
      <CardHeader>
        <CardTitle>Liste des expériences</CardTitle>
      </CardHeader>

      <CardContent>
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b">
              <th class="py-2">Poste</th>
              <th class="py-2">Entreprise</th>
              <th class="py-2">Lieu</th>
              <th class="py-2">Dates</th>
              <th class="py-2">Type</th>
              <th class="py-2"></th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="exp in experiences"
              :key="exp.id"
              class="border-b hover:bg-muted/20"
            >
              <td class="py-2">{{ exp.position }}</td>
              <td>{{ exp.company }}</td>
              <td>{{ exp.location }}</td>
              <td>{{ exp.start_date }} → {{ exp.end_date || 'Présent' }}</td>
              <td>{{ exp.type }}</td>

              <td class="text-right">
                <Link
                  :href="`/experiences/${exp.id}/edit`"
                  class="mr-3 text-primary hover:underline"
                >
                  Modifier
                </Link>

                <Link
                  as="button"
                  method="delete"
                  :href="`/experiences/${exp.id}`"
                  class="text-red-600 hover:underline"
                >
                  Supprimer
                </Link>
              </td>
            </tr>

            <tr v-if="experiences.length === 0">
              <td colspan="6" class="py-4 text-center text-muted-foreground">
                Aucune expérience trouvée.
              </td>
            </tr>
          </tbody>
        </table>
      </CardContent>
    </Card>
  </div>
</template>
