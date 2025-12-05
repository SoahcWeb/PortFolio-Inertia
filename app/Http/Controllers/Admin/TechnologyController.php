<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Liste technologies avec pagination et tri
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'order');
        $direction = $request->get('direction', 'asc');

        $technologies = Technology::orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Back/Technologies/Index', [
            'technologies' => $technologies,
            'filters' => compact('sort', 'direction'),
        ]);
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        return Inertia::render('Back/Technologies/Create');
    }

    /**
     * Stocker nouvelle technologie
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', Rule::in(['Backend','Frontend','BDD','DevOps','Design'])],
            'level' => ['required', Rule::in(['Débutant','Intermédiaire','Avancé','Expert'])],
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('technologies', 'public');
        }

        Technology::create($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology created.');
    }

    /**
     * Formulaire édition
     */
    public function edit(Technology $technology)
    {
        return Inertia::render('Back/Technologies/Edit', compact('technology'));
    }

    /**
     * Mettre à jour technologie
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', Rule::in(['Backend','Frontend','BDD','DevOps','Design'])],
            'level' => ['required', Rule::in(['Débutant','Intermédiaire','Avancé','Expert'])],
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            if ($technology->logo) {
                Storage::disk('public')->delete($technology->logo);
            }
            $data['logo'] = $request->file('logo')->store('technologies', 'public');
        }

        $technology->update($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Technology updated.');
    }

    /**
     * Supprimer technologie
     */
    public function destroy(Technology $technology)
    {
        if ($technology->logo) {
            Storage::disk('public')->delete($technology->logo);
        }

        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted.');
    }
}
