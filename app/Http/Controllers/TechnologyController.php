<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TechnologyController extends Controller
{
    /**
     * Affiche la liste des technologies
     */
    public function index()
    {
        $technologies = Technology::orderBy('order')->get();
        return Inertia::render('Technologies/Index', [
            'technologies' => $technologies
        ]);
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return Inertia::render('Technologies/Create');
    }

    /**
     * Enregistrement d'une nouvelle technologie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Backend,Frontend,BDD,DevOps,Design',
            'level' => 'required|string|in:Débutant,Intermédiaire,Avancé,Expert',
            'color' => 'nullable|string|size:7',
            'order' => 'nullable|integer|min:0',
            'logo' => 'nullable|image|max:5120', // 5MB
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        Technology::create($validated);

        return redirect()->route('technologies.index')->with('success', 'Technologie créée avec succès.');
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Technology $technology)
    {
        return Inertia::render('Technologies/Edit', [
            'technology' => $technology
        ]);
    }

    /**
     * Mise à jour d'une technologie
     */
    public function update(Request $request, Technology $technology)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Backend,Frontend,BDD,DevOps,Design',
            'level' => 'required|string|in:Débutant,Intermédiaire,Avancé,Expert',
            'color' => 'nullable|string|size:7',
            'order' => 'nullable|integer|min:0',
            'logo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo si existant
            if ($technology->logo_path) {
                Storage::disk('public')->delete($technology->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        $technology->update($validated);

        return redirect()->route('technologies.index')->with('success', 'Technologie mise à jour avec succès.');
    }

    /**
     * Suppression d'une technologie
     */
    public function destroy(Technology $technology)
    {
        if ($technology->logo_path) {
            Storage::disk('public')->delete($technology->logo_path);
        }

        $technology->delete();

        return redirect()->route('technologies.index')->with('success', 'Technologie supprimée avec succès.');
    }
}


