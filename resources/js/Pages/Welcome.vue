<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: { type: String, required: true },
    phpVersion: { type: String, required: true },
    // On peut ajouter des URLs depuis Laravel si besoin
    loginUrl: { type: String, default: '/login' },
    registerUrl: { type: String, default: '/register' },
    dashboardUrl: { type: String, default: '/dashboard' },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <!-- Auth Links -->
        <div v-if="canLogin" class="p-6 sm:fixed sm:top-0 sm:right-0 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="dashboardUrl"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="loginUrl"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="registerUrl"
                    class="font-semibold text-gray-600 ms-4 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                    Register
                </Link>
            </template>
        </div>

        <!-- Main Content -->
        <div class="p-6 mx-auto max-w-7xl lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white">
                    Bienvenue sur votre projet Laravel + Inertia + Vue 🎉
                </h1>
            </div>

            <div class="flex justify-center mt-10">
                <Link
                    href="/"
                    class="px-6 py-3 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"
                >
                    Aller à Home
                </Link>
            </div>

            <div class="flex justify-center mt-16 text-sm text-gray-500 dark:text-gray-400">
                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
