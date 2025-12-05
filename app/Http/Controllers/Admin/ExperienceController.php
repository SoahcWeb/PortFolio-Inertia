<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'start_date');
        $direction = $request->get('direction', 'desc');

        $experiences = Experience::orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Experiences/Index', compact('experiences'))
            ->with('filters', compact('sort', 'direction'));
    }

    public function create()
    {
        return Inertia::render('Admin/Experiences/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:50',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Experience::create($data);

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience créée.');
    }

    public function edit(Experience $experience)
    {
        return Inertia::render('Admin/Experiences/Edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'type'        => 'nullable|string|max:50',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $experience->update($data);

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience mise à jour.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience supprimée.');
    }
}
