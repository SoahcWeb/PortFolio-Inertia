<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    // Liste des expériences avec pagination et tri
    public function index(Request $request)
    {
        $experiences = Experience::orderBy(
            $request->get('sort', 'start_date'),
            $request->get('direction', 'desc')
        )->paginate(10);

        return Inertia::render('Admin/Experiences/Index', compact('experiences'));
    }

    // Formulaire de création
    public function create()
    {
        return Inertia::render('Admin/Experiences/Create');
    }

    // Stockage d'une nouvelle expérience
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Expérience créée avec succès.');
    }

    // Formulaire de modification
    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return Inertia::render('Admin/Experiences/Edit', compact('experience'));
    }

    // Mise à jour d'une expérience
    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Expérience mise à jour avec succès.');
    }

    // Suppression d'une expérience
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Expérience supprimée avec succès.');
    }
}
