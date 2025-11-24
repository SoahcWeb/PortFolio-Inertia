<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index()
    {
        return Inertia::render('Experiences/Index', [
            'experiences' => Experience::orderByDesc('start_date')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Experiences/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'type'        => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Experience::create($data);

        return redirect()->route('experiences.index')->with('success', 'Expérience créée.');
    }

    public function edit(Experience $experience)
    {
        return Inertia::render('Experiences/Edit', [
            'experience' => $experience,
        ]);
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'type'        => 'required|string',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $experience->update($data);

        return redirect()->route('experiences.index')->with('success', 'Expérience mise à jour.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('experiences.index')->with('success', 'Expérience supprimée.');
    }
}
