<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormationController extends Controller
{
    public function index()
    {
        return Inertia::render('Formations/Index', [
            'formations' => Formation::orderByDesc('start_date')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Formations/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'degree'      => 'required|string|max:255',
            'school'      => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Formation::create($data);

        return redirect()->route('formations.index')->with('success', 'Formation créée.');
    }

    public function edit(Formation $formation)
    {
        return Inertia::render('Formations/Edit', [
            'formation' => $formation,
        ]);
    }

    public function update(Request $request, Formation $formation)
    {
        $data = $request->validate([
            'degree'      => 'required|string|max:255',
            'school'      => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
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
