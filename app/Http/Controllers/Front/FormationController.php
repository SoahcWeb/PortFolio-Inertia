<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::orderByDesc('start_date')->get();
        return Inertia::render('Front/Formations/Index', [
            'formations' => $formations,
        ]);
    }

    public function create()
    {
        return Inertia::render('Front/Formations/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'degree'      => 'required|string|max:255',
            'school'      => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Formation::create($data);

        return redirect()->route('formations.index')->with('success', 'Formation créée.');
    }

    public function edit(Formation $formation)
    {
        return Inertia::render('Front/Formations/Edit', [
            'formation' => $formation,
        ]);
    }

    public function update(Request $request, Formation $formation)
    {
        $data = $request->validate([
            'degree'      => 'required|string|max:255',
            'school'      => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $formation->update($data);

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('formations.index')->with('success', 'Formation supprimée.');
    }
}
