<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    public function index()
    {
        $info = PersonalInfo::first();

        return Inertia::render('Front/PersonalInfo/Index', compact('info'));
    }

    public function edit()
    {
        $info = PersonalInfo::first();

        return Inertia::render('Front/PersonalInfo/Edit', compact('info'));
    }

    public function update(Request $request)
    {
        $info = PersonalInfo::first() ?? new PersonalInfo();

        $data = $request->validate([
            'full_name'     => 'required|string|max:255',
            'title'         => 'required|string|max:255',
            'bio'           => 'nullable|string',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'availability'  => 'nullable|string|max:255',
            'linkedin'      => 'nullable|url|max:255',
            'github'        => 'nullable|url|max:255',
            'twitter'       => 'nullable|url|max:255',
            'profile_photo' => 'nullable|image|max:5120',
            'cv_path'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($info->profile_photo && Storage::disk('public')->exists($info->profile_photo)) {
                Storage::disk('public')->delete($info->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profile', 'public');
        }

        if ($request->hasFile('cv_path')) {
            if ($info->cv_path && Storage::disk('public')->exists($info->cv_path)) {
                Storage::disk('public')->delete($info->cv_path);
            }
            $data['cv_path'] = $request->file('cv_path')->store('cv', 'public');
        }

        $info->fill($data)->save();

        return redirect()->route('personal-info.index')->with('success', 'Informations personnelles mises à jour.');
    }
}
