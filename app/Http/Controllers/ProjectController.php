<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies')->orderBy('order')->get();
        return Inertia::render('Projects/Index', compact('projects'));
    }

    public function create()
    {
        $technologies = Technology::all();
        return Inertia::render('Projects/Create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug',
            'description_short' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['Site web','App mobile','API','Design'])],
            'status' => ['required', Rule::in(['Brouillon','Publié','Archivé'])],
            'date' => 'nullable|date',
            'client' => 'nullable|string|max:255',
            'context' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'link_project' => 'nullable|url|max:255',
            'link_github' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'main_image' => 'nullable|image|max:5120', // max 5MB
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id'
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        $project = Project::create($data);

        if (!empty($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $project->load('technologies');
        return Inertia::render('Projects/Edit', compact('project', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required','string','max:255', Rule::unique('projects','slug')->ignore($project->id)],
            'description_short' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => ['required', Rule::in(['Site web','App mobile','API','Design'])],
            'status' => ['required', Rule::in(['Brouillon','Publié','Archivé'])],
            'date' => 'nullable|date',
            'client' => 'nullable|string|max:255',
            'context' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'link_project' => 'nullable|url|max:255',
            'link_github' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'main_image' => 'nullable|image|max:5120',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id'
        ]);

        if ($request->hasFile('main_image')) {
            if ($project->main_image) {
                Storage::disk('public')->delete($project->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('projects', 'public');
        }

        $project->update($data);

        if (!empty($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        if ($project->main_image) {
            Storage::disk('public')->delete($project->main_image);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
}
