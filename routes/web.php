<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// FRONT
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PersonalInfoController;

// BACKOFFICE ADMIN
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\FormationController as AdminFormationController;

// ----------------------------------------------------
// FRONT
// ----------------------------------------------------
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'laravelVersion' => app()->version(),
        'phpVersion' => phpversion(),
        // Tu peux ajouter ici d'autres URLs si nécessaire, par exemple :
        // 'dashboardUrl' => route('dashboard'),
    ]);
});

// Auth + Verified
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**
     * -----------------------------------------
     * BACKOFFICE ROUTES
     * -----------------------------------------
     */
    Route::prefix('admin')->name('admin.')->group(function () {

        // 🌐 Technologies (CRUD complet)
        Route::resource('technologies', AdminTechnologyController::class);

        // 🧱 Projects (CRUD + images)
        Route::resource('projects', AdminProjectController::class);

        // Galerie AJAX
        Route::post('projects/{project}/gallery/add', [AdminProjectController::class, 'addGallery'])
            ->name('projects.addGallery');
        Route::post('projects/{project}/gallery/remove', [AdminProjectController::class, 'removeGallery'])
            ->name('projects.removeGallery');
        Route::post('projects/{project}/gallery/reorder', [AdminProjectController::class, 'reorderGallery'])
            ->name('projects.reorderGallery');

        // 🕓 Experiences
        Route::resource('experiences', AdminExperienceController::class);

        // 🎓 Formations
        Route::resource('formations', AdminFormationController::class);

        // 👤 PersonalInfo — Singleton (SHOW + EDIT + UPDATE)
        Route::get('personal-info', [PersonalInfoController::class, 'edit'])
            ->name('personal-info.edit');

        Route::put('personal-info', [PersonalInfoController::class, 'update'])
            ->name('personal-info.update');
    });
});
