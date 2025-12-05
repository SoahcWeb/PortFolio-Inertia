<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;

// FRONT
use App\Http\Controllers\Front\ProjectController as FrontProjectController;
use App\Http\Controllers\Front\ExperienceController as FrontExperienceController;
use App\Http\Controllers\Front\FormationController as FrontFormationController;
use App\Http\Controllers\Front\PersonalInfoController as FrontPersonalInfoController;
use App\Http\Controllers\Front\TechnologyController as FrontTechnologyController;

// BACK / ADMIN
use App\Http\Controllers\Admin\ProjectController as BackProjectController;
use App\Http\Controllers\Admin\TechnologyController as BackTechnologyController;
use App\Http\Controllers\Admin\ExperienceController as BackExperienceController;
use App\Http\Controllers\Admin\FormationController as BackFormationController;
use App\Http\Controllers\Admin\PersonalInfoController as BackPersonalInfoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return Inertia::render('Shared/LandingPage');
});

// Home front publique
Route::get('/home', function () {
    return Inertia::render('Front/Home');
})->name('front.home');

// ------------------------------
// FRONT OFFICE
// ------------------------------
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [FrontProjectController::class, 'index'])->name('index');
    Route::get('/create', [FrontProjectController::class, 'create'])->name('create');
    Route::post('/', [FrontProjectController::class, 'store'])->name('store');
    Route::get('/{project}/edit', [FrontProjectController::class, 'edit'])->name('edit');
    Route::put('/{project}', [FrontProjectController::class, 'update'])->name('update');
    Route::delete('/{project}', [FrontProjectController::class, 'destroy'])->name('destroy');
});

// Experiences front
Route::prefix('experiences')->name('experiences.')->group(function () {
    Route::get('/', [FrontExperienceController::class, 'index'])->name('index');
    Route::get('/create', [FrontExperienceController::class, 'create'])->name('create');
    Route::post('/', [FrontExperienceController::class, 'store'])->name('store');
    Route::get('/{experience}/edit', [FrontExperienceController::class, 'edit'])->name('edit');
    Route::put('/{experience}', [FrontExperienceController::class, 'update'])->name('update');
    Route::delete('/{experience}', [FrontExperienceController::class, 'destroy'])->name('destroy');
});

// Formations front
Route::prefix('formations')->name('formations.')->group(function () {
    Route::get('/', [FrontFormationController::class, 'index'])->name('index');
    Route::get('/create', [FrontFormationController::class, 'create'])->name('create');
    Route::post('/', [FrontFormationController::class, 'store'])->name('store');
    Route::get('/{formation}/edit', [FrontFormationController::class, 'edit'])->name('edit');
    Route::put('/{formation}', [FrontFormationController::class, 'update'])->name('update');
    Route::delete('/{formation}', [FrontFormationController::class, 'destroy'])->name('destroy');
});

// Personal Info front
Route::prefix('personal-info')->name('personal-info.')->group(function () {
    Route::get('/', [FrontPersonalInfoController::class, 'index'])->name('index');
    Route::get('/edit', [FrontPersonalInfoController::class, 'edit'])->name('edit');
    Route::put('/', [FrontPersonalInfoController::class, 'update'])->name('update');
});

// Technologies front
Route::prefix('technologies')->name('technologies.')->group(function () {
    Route::get('/', [FrontTechnologyController::class, 'index'])->name('index');
    Route::get('/create', [FrontTechnologyController::class, 'create'])->name('create');
    Route::post('/', [FrontTechnologyController::class, 'store'])->name('store');
    Route::get('/{technology}/edit', [FrontTechnologyController::class, 'edit'])->name('edit');
    Route::put('/{technology}', [FrontTechnologyController::class, 'update'])->name('update');
    Route::delete('/{technology}', [FrontTechnologyController::class, 'destroy'])->name('destroy');
});

// ------------------------------
// ADMIN / BACK OFFICE
// ------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Back/Dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        // Technologies CRUD
        Route::resource('technologies', BackTechnologyController::class);

        // Projects CRUD
        Route::resource('projects', BackProjectController::class);

        // Gallery actions
        Route::post('projects/{project}/gallery/add', [BackProjectController::class, 'addGallery'])
            ->name('projects.addGallery');
        Route::post('projects/{project}/gallery/remove', [BackProjectController::class, 'removeGallery'])
            ->name('projects.removeGallery');
        Route::post('projects/{project}/gallery/reorder', [BackProjectController::class, 'reorderGallery'])
            ->name('projects.reorderGallery');

        // Experiences CRUD
        Route::resource('experiences', BackExperienceController::class);

        // Formations CRUD
        Route::resource('formations', BackFormationController::class);

        // Personal Info
        Route::get('personal-info', [BackPersonalInfoController::class, 'edit'])->name('personal-info.edit');
        Route::put('personal-info', [BackPersonalInfoController::class, 'update'])->name('personal-info.update');
    });

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';
