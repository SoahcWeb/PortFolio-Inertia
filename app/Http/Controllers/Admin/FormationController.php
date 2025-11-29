<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class FormationController extends Controller
{
    /**
     * Liste des formations avec tri et pagination
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'start_date');       // colonne par défaut
        $direction = $request->get('direction', 'desc');  // sens par défaut

        $formations = Formation::orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString(); // pour garder les filtres dans l'URL

        return Inertia::render('Admin/Formations/Index', [
            'formations' => $formations,
            'filters' => [
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return Inertia::render('Admin/Formations/Create');
    }

    /**
     * Enregistrer une nouvelle formation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'school'       => 'required|string|max:255',
            'location'     => 'nullable|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'is_current'   => 'boolean',
            'description'  => 'nullable|string',
            'logo'         => 'nullable|image|max:2048',
        ]);

        // Upload logo si présent
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('formations', 'public');
        }

        Formation::create($validated);

        return redirect()
            ->route('admin.formations.index')
            ->with('success', 'Formation ajoutée avec succès !');
    }

    /**
     * Formulaire d’édition
     */
    public function edit($id)
    {
        $formation = Formation::findOrFail($id);

        return Inertia::render('Admin/Formations/Edit', [
            'formation' => $formation,
        ]);
    }

    /**
     * Mettre à jour la formation
     */
    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'school'       => 'required|string|max:255',
            'location'     => 'nullable|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'is_current'   => 'boolean',
            'description'  => 'nullable|string',
            'logo'         => 'nullable|image|max:2048',
        ]);

        // Si nouveau logo, supprimer l'ancien
        if ($request->hasFile('logo')) {
            if ($formation->logo && Storage::disk('public')->exists($formation->logo)) {
                Storage::disk('public')->delete($formation->logo);
            }
            $validated['logo'] = $request->file('logo')->store('formations', 'public');
        }

        $formation->update($validated);

        return redirect()
            ->route('admin.formations.index')
            ->with('success', 'Formation modifiée avec succès !');
    }

    /**
     * Supprimer une formation
     */
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);

        // Supprimer le logo si existant
        if ($formation->logo && Storage::disk('public')->exists($formation->logo)) {
            Storage::disk('public')->delete($formation->logo);
        }

        $formation->delete();

        return redirect()
            ->route('admin.formations.index')
            ->with('success', 'Formation supprimée.');
    }
}
