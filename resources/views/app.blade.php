<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS / Vite -->
    @vite('resources/css/app.css')

    <!-- Inertia Head -->
    @inertiaHead
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">

    <!-- Inertia root -->
    @inertia

    <!-- Scripts JS -->
    @vite('resources/js/app.js')
</body>
</html>

<script>
console.log('Laravel + Inertia + Vue fonctionne !');
</script>

