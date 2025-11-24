<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PersonalInfoController;

Route::get('/', function () {
    return Inertia::render('Welcome');
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
        Route::resource('technologies', TechnologyController::class);

        // 🧱 Projects (CRUD + images)
        Route::resource('projects', ProjectController::class);

        // 🕓 Experiences
        Route::resource('experiences', ExperienceController::class);

        // 🎓 Formations
        Route::resource('formations', FormationController::class);

        // 👤 PersonalInfo — Singleton (SHOW + EDIT + UPDATE)
        Route::get('personal-info', [PersonalInfoController::class, 'edit'])
            ->name('personal-info.edit');

        Route::put('personal-info', [PersonalInfoController::class, 'update'])
            ->name('personal-info.update');
    });

});
