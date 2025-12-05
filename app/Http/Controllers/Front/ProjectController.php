<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Affichage de tous les projets (partie publique)
     */
    public function index()
    {
        $projects = Project::with('technologies')
            ->where('status', 'Publié')
            ->orderBy('order')
            ->get();

        return Inertia::render('Front/Projects/Index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Affichage d’un seul projet (partie publique)
     */
    public function show(Project $project)
    {
        if ($project->status !== 'Publié') {
            abort(404);
        }

        $project->load('technologies');

        return Inertia::render('Front/Projects/Show', [
            'project' => $project,
        ]);
    }
}
