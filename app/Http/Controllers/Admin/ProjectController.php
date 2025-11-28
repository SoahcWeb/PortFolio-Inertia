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
    // Liste des projets avec filtrage
    public function index(Request $request)
    {
        $query = Project::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($techId = $request->input('technology')) {
            $query->whereHas('technologies', fn($q) => $q->where('id', $techId));
        }

        $projects = $query->with('technologies')->get();
        $technologies = Technology::all();

        return Inertia::render('Admin/Projects/Index', [
            'projects' => $projects,
            'technologies' => $technologies,
        ]);
    }

    // Formulaire création
    public function create()
    {
        $technologies = Technology::all();

        return Inertia::render('Admin/Projects/Create', [
            'technologies' => $technologies,
        ]);
    }

    // Stockage projet
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'technologies' => 'nullable|array',
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('projects/gallery', 'public');
            }
        }
        $data['gallery'] = $gallery;

        $project = Project::create($data);

        if (!empty($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé !');
    }

    // Formulaire édition
    public function edit(Project $project)
    {
        $technologies = Technology::all();

        return Inertia::render('Admin/Projects/Edit', [
            'project' => $project->load('technologies'),
            'technologies' => $technologies,
        ]);
    }

    // Mise à jour projet
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'technologies' => 'nullable|array',
        ]);

        if ($request->hasFile('main_image')) {
            if ($project->main_image) {
                Storage::disk('public')->delete($project->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = $project->gallery ?? [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $project->update($data);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour !');
    }

    // Supprimer projet
    public function destroy(Project $project)
    {
        if ($project->main_image) {
            Storage::disk('public')->delete($project->main_image);
        }

        if ($project->gallery) {
            foreach ($project->gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $project->technologies()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé !');
    }

    // 🔹 Ajouter des images à la galerie
    public function addGallery(Request $request, Project $project)
    {
        $request->validate([
            'gallery.*' => 'required|image|max:2048',
        ]);

        $gallery = $project->gallery ?? [];

        foreach ($request->file('gallery') as $image) {
            $gallery[] = $image->store('projects/gallery', 'public');
        }

        $project->update(['gallery' => $gallery]);

        return response()->json(['gallery' => $project->gallery_urls]);
    }

    // 🔹 Supprimer une image de la galerie
    public function removeGallery(Request $request, Project $project)
    {
        $request->validate(['index' => 'required|integer']);
        $gallery = $project->gallery ?? [];

        if (isset($gallery[$request->index])) {
            Storage::disk('public')->delete($gallery[$request->index]);
            array_splice($gallery, $request->index, 1);
            $project->update(['gallery' => $gallery]);
        }

        return response()->json(['gallery' => $project->gallery_urls]);
    }

    // 🔹 Réorganisation de la galerie (drag & drop)
    public function reorderGallery(Request $request, Project $project)
    {
        $request->validate([
            'gallery' => 'required|array',
        ]);

        $gallery = array_values(array_unique($request->gallery)); // Supprime doublons
        $project->update(['gallery' => $gallery]);

        return response()->json(['gallery' => $project->gallery_urls]);
    }
}
