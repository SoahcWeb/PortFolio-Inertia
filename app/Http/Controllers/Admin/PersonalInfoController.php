<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    /**
     * Afficher le formulaire d'édition
     */
    public function edit()
    {
        // Crée un enregistrement vide si aucun n'existe
        $personalInfo = PersonalInfo::first();
        if (!$personalInfo) {
            $personalInfo = PersonalInfo::create([
                'profile_photo' => null,
                'cv' => null,
                'linkedin' => '',
                'github' => '',
                'availability' => '',
            ]);
        }

        return Inertia::render('Admin/PersonalInfo/Edit', [
            'personalInfo' => $personalInfo
        ]);
    }

    /**
     * Mettre à jour les infos personnelles
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'profile_photo' => 'nullable|image|max:2048',
            'cv'            => 'nullable|mimes:pdf,doc,docx|max:5120',
            'linkedin'      => 'nullable|url|max:255',
            'github'        => 'nullable|url|max:255',
            'availability'  => 'nullable|string|max:255',
        ]);

        $personalInfo = PersonalInfo::first();

        // Upload photo profil
        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('personal', 'public');
        }

        // Upload CV
        if ($request->hasFile('cv')) {
            $validated['cv'] = $request->file('cv')->store('personal', 'public');
        }

        $personalInfo->update($validated);

        return redirect()
            ->route('admin.personal-info.edit')
            ->with('success', 'Infos personnelles mises à jour avec succès !');
    }
}
