<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Liste des projets avec pagination + filtres
     */
    public function index(Request $request)
    {
        $query = Project::query();

        // Recherche par titre
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        // Filtre par technologie
        if ($techId = $request->input('technology')) {
            $query->whereHas('technologies', fn($q) => $q->where('id', $techId));
        }

        // 10 par page avec technologies chargées et tri par date de création
        $projects = $query->with('technologies')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10)
                         ->withQueryString();

        return Inertia::render('Back/Projects/Index', [
            'projects' => $projects,
            'technologies' => Technology::all(),
        ]);
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return Inertia::render('Back/Projects/Create', [
            'technologies' => Technology::all(),
        ]);
    }

    /**
     * Stockage d'un projet
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'main_image'     => 'nullable|image|max:2048',
            'gallery.*'      => 'nullable|image|max:2048',
            'technologies'   => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        // Image principale
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        // Galerie d'images
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('projects/gallery', 'public');
            }
        }
        $data['gallery'] = $gallery;

        // Création du projet
        $project = Project::create($data);

        // Technologies associées
        if (!empty($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé !');
    }

    /**
     * Formulaire d’édition
     */
    public function edit(Project $project)
    {
        return Inertia::render('Back/Projects/Edit', [
            'project' => $project->load('technologies'),
            'technologies' => Technology::all(),
        ]);
    }

    /**
     * Mise à jour du projet
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'main_image'      => 'nullable|image|max:2048',
            'gallery.*'       => 'nullable|image|max:2048',
            'remove_gallery'  => 'nullable|array',
            'technologies'    => 'nullable|array',
            'technologies.*'  => 'exists:technologies,id',
        ]);

        // Image principale
        if ($request->hasFile('main_image')) {
            if ($project->main_image) {
                Storage::disk('public')->delete($project->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        // Galerie
        $existingGallery = $project->gallery ?? [];

        // Suppression des images sélectionnées
        if (!empty($data['remove_gallery'])) {
            foreach ($data['remove_gallery'] as $imagePath) {
                $index = array_search($imagePath, $existingGallery);
                if ($index !== false) {
                    Storage::disk('public')->delete($existingGallery[$index]);
                    unset($existingGallery[$index]);
                }
            }
            $existingGallery = array_values($existingGallery);
        }

        // Ajout de nouvelles images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $existingGallery[] = $image->store('projects/gallery', 'public');
            }
        }
        $data['gallery'] = $existingGallery;

        // Mise à jour du projet
        $project->update($data);

        // Mise à jour des technologies associées
        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour !');
    }

    /**
     * Suppression du projet
     */
    public function destroy(Project $project)
    {
        // Supprimer image principale
        if ($project->main_image) {
            Storage::disk('public')->delete($project->main_image);
        }

        // Supprimer images galerie
        if ($project->gallery) {
            foreach ($project->gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Détacher technologies
        $project->technologies()->detach();

        // Supprimer le projet
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé !');
    }
}
