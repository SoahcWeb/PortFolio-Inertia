<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderBy('order')->get();
        return Inertia::render('Front/Technologies/Index', compact('technologies'));
    }

    public function create()
    {
        return Inertia::render('Front/Technologies/Create');
    }

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

        return redirect()->route('technologies.index')->with('success', 'Technology créée.');
    }

    public function edit(Technology $technology)
    {
        return Inertia::render('Front/Technologies/Edit', compact('technology'));
    }

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

        return redirect()->route('technologies.index')->with('success', 'Technology mise à jour.');
    }

    public function destroy(Technology $technology)
    {
        if ($technology->logo) {
            Storage::disk('public')->delete($technology->logo);
        }

        $technology->delete();

        return redirect()->route('technologies.index')->with('success', 'Technology supprimée.');
    }
}
