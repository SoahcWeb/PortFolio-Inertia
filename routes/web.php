<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FormationController;
use App\Http\Controllers\PersonalInfoController;

// Page d'accueil
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard protégé
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'auth' => ['user' => auth()->user()],
        'errors' => session('errors') ?: new \Illuminate\Support\ViewErrorBag(),
        'flash' => session()->only(['message']),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées par auth
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Backoffice admin
    Route::prefix('admin')->name('admin.')->group(function () {

        // Technologies CRUD
        Route::resource('technologies', TechnologyController::class);

        // Projects CRUD + gallery
        Route::resource('projects', ProjectController::class);
        Route::post('projects/{project}/gallery/add', [ProjectController::class, 'addGallery'])->name('projects.addGallery');
        Route::post('projects/{project}/gallery/remove', [ProjectController::class, 'removeGallery'])->name('projects.removeGallery');
        Route::post('projects/{project}/gallery/reorder', [ProjectController::class, 'reorderGallery'])->name('projects.reorderGallery');

        // Experiences
        Route::resource('experiences', ExperienceController::class);

        // Formations
        Route::resource('formations', FormationController::class);

        // Personal Info (singleton)
        Route::get('personal-info', [PersonalInfoController::class, 'edit'])->name('personal-info.edit');
        Route::put('personal-info', [PersonalInfoController::class, 'update'])->name('personal-info.update');
    });
});

require __DIR__.'/auth.php';
