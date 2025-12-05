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
            $personalInfo = PersonalInfo::create([
                'profile_photo' => null,
                'cv' => null,
                'linkedin' => '',
                'github' => '',
                'availability' => '',
            ]);
        }

        return Inertia::render('Back/PersonalInfo/Edit', compact('personalInfo'));
    }

    public function update(Request $request)
    {
        $personalInfo = PersonalInfo::firstOrFail();

        $validated = $request->validate([
            'full_name'     => 'nullable|string|max:255',
            'title'         => 'nullable|string|max:255',
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
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($personalInfo->profile_photo && Storage::disk('public')->exists($personalInfo->profile_photo)) {
                Storage::disk('public')->delete($personalInfo->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('personal', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($personalInfo->cv && Storage::disk('public')->exists($personalInfo->cv)) {
                Storage::disk('public')->delete($personalInfo->cv);
            }
            $validated['cv'] = $request->file('cv')->store('personal', 'public');
        }

        $personalInfo->update($validated);

        return redirect()
            ->route('admin.personal-info.edit')
            ->with('success', 'Informations personnelles mises à jour avec succès !');
    }
}
