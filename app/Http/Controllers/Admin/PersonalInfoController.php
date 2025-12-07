<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    /**
     * Affiche le formulaire d'édition des infos personnelles.
     */
    public function edit()
    {
        // Récupère le premier enregistrement
        $info = PersonalInfo::first();

        // Si aucun record, en créer un vide
        if (!$info) {
            $info = PersonalInfo::create([
                'first_name'   => 'John',
                'last_name'    => 'Doe',
                'nickname'     => 'Johnny',
                'full_name'    => '', // inutilisé pour le moment
                'job_title'    => 'Profil professionnel',
                'bio'          => 'Bio de John',
                'email'        => 'john@example.com',
                'phone'        => '+33 6 12 34 56 78',
                'location'     => 'Paris, France',
                'availability' => 'Disponible',
                'linkedin'     => '',
                'github'       => '',
                'twitter'      => '',
                'facebook'     => '',
                'youtube'      => '',
                'tiktok'       => '',
                'profile_photo'=> null,
                'cv'           => null,
            ]);
        }

        // Renvoi à Inertia avec toutes les infos
        return Inertia::render('Back/PersonalInfo/Edit', [
            'personalInfo' => $info->toArray(), // ← important pour que Vue voie toutes les propriétés
        ]);
    }

    /**
     * Met à jour les infos personnelles.
     */
    public function update(Request $request)
    {
        $info = PersonalInfo::firstOrFail();

        $data = $request->validate([
            'first_name'   => 'nullable|string|max:255',
            'last_name'    => 'nullable|string|max:255',
            'nickname'     => 'nullable|string|max:255',
            'full_name'    => 'nullable|string|max:255',
            'job_title'    => 'nullable|string|max:255',
            'bio'          => 'nullable|string',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:255',
            'location'     => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'linkedin'     => 'nullable|string|max:255',
            'github'       => 'nullable|string|max:255',
            'twitter'      => 'nullable|string|max:255',
            'facebook'     => 'nullable|string|max:255',
            'youtube'      => 'nullable|string|max:255',
            'tiktok'       => 'nullable|string|max:255',
            'profile_photo'=> 'nullable|image|max:5120',
            'cv'           => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Upload photo
        if ($request->hasFile('profile_photo')) {
            if ($info->profile_photo) {
                Storage::disk('public')->delete($info->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('personal', 'public');
        }

        // Upload CV
        if ($request->hasFile('cv')) {
            if ($info->cv) {
                Storage::disk('public')->delete($info->cv);
            }
            $data['cv'] = $request->file('cv')->store('personal', 'public');
        }

        $info->update($data);

        return back()->with('success', 'Informations mises à jour.');
    }
}
