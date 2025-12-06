<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    public function edit()
    {
        $personalInfo = PersonalInfo::first();

        if (!$personalInfo) {
            // Création automatique d'un profil vide avec valeurs par défaut
            $personalInfo = PersonalInfo::create([
                'full_name'     => 'Utilisateur',
                'job_title'     => null,
                'bio'           => null,
                'email'         => null,
                'phone'         => null,
                'location'      => null,
                'profile_photo' => null,
                'cv'            => null,
                'linkedin'      => '',
                'github'        => '',
                'twitter'       => '',
                'availability'  => '',
            ]);
        }

        return Inertia::render('Back/PersonalInfo/Edit', [
            'personalInfo' => $personalInfo
        ]);
    }

    public function update(Request $request)
    {
        $personalInfo = PersonalInfo::firstOrFail();

        $validated = $request->validate([
            'full_name'     => 'nullable|string|max:255',
            'job_title'     => 'nullable|string|max:255',
            'bio'           => 'nullable|string',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'availability'  => 'nullable|string|max:255',
            'linkedin'      => 'nullable|url|max:255',
            'github'        => 'nullable|url|max:255',
            'twitter'       => 'nullable|url|max:255',
            'profile_photo' => 'nullable|image|max:5120',
            'cv'            => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'remove_profile_photo' => 'nullable|boolean',
            'remove_cv' => 'nullable|boolean',
        ]);

        // Gestion suppression photo
        if (!empty($validated['remove_profile_photo']) && $personalInfo->profile_photo) {
            Storage::disk('public')->delete($personalInfo->profile_photo);
            $personalInfo->profile_photo = null;
        }

        // Gestion suppression CV
        if (!empty($validated['remove_cv']) && $personalInfo->cv) {
            Storage::disk('public')->delete($personalInfo->cv);
            $personalInfo->cv = null;
        }

        // Upload nouvelle photo
        if ($request->hasFile('profile_photo')) {
            if ($personalInfo->profile_photo) {
                Storage::disk('public')->delete($personalInfo->profile_photo);
            }
            $personalInfo->profile_photo = $request->file('profile_photo')->store('personal', 'public');
        }

        // Upload nouveau CV
        if ($request->hasFile('cv')) {
            if ($personalInfo->cv) {
                Storage::disk('public')->delete($personalInfo->cv);
            }
            $personalInfo->cv = $request->file('cv')->store('personal', 'public');
        }

        // Mise à jour des autres champs
        $personalInfo->full_name    = $validated['full_name'] ?? $personalInfo->full_name;
        $personalInfo->job_title    = $validated['job_title'] ?? $personalInfo->job_title;
        $personalInfo->bio          = $validated['bio'] ?? $personalInfo->bio;
        $personalInfo->email        = $validated['email'] ?? $personalInfo->email;
        $personalInfo->phone        = $validated['phone'] ?? $personalInfo->phone;
        $personalInfo->location     = $validated['location'] ?? $personalInfo->location;
        $personalInfo->linkedin     = $validated['linkedin'] ?? $personalInfo->linkedin;
        $personalInfo->github       = $validated['github'] ?? $personalInfo->github;
        $personalInfo->twitter      = $validated['twitter'] ?? $personalInfo->twitter;
        $personalInfo->availability = $validated['availability'] ?? $personalInfo->availability;

        // Sauvegarde
        $personalInfo->save();

        return redirect()->route('admin.personal-info.edit')
                         ->with('success', 'Informations personnelles mises à jour avec succès !');
    }
}
