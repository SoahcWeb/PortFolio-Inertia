<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Application Web (Front + Backoffice)
|
*/

// 🔹 Page d'accueil (Index.vue)
Route::get('/', function () {
    return Inertia::render('Index'); // Correspond à resources/js/Pages/Index.vue
})->name('home'); // Le nom 'home' sert juste pour référencer la route dans Laravel

// 🔹 Dashboard protégé
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard'); // Correspond à resources/js/Pages/Dashboard.vue
    })->name('dashboard');
});

// 🔹 Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
