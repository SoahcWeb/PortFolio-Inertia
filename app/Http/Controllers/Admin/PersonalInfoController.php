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
        $info = PersonalInfo::first();

        if (!$info) {
            $info = PersonalInfo::create([
                'first_name'   => 'John',
                'last_name'    => 'Doe',
                'nickname'     => 'Johnny',
                'full_name'    => '',
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

        return Inertia::render('Back/PersonalInfo/Edit', [
            'personalInfo' => $info->toArray(),
        ]);
    }

    /**
     * Met à jour les infos personnelles via POST.
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
            $file = $request->file('profile_photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/profile', $filename);
            $data['profile_photo'] = 'profile/'.$filename;
        }

        // Upload CV
        if ($request->hasFile('cv')) {
            if ($info->cv) {
                Storage::disk('public')->delete($info->cv);
            }
            $file = $request->file('cv');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/profile', $filename);
            $data['cv'] = 'profile/'.$filename;
        }

        $info->update($data);

        return back()->with('success', 'Informations mises à jour.');
    }
}
