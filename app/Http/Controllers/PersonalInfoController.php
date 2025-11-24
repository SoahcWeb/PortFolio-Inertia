<?php

namespace App\Http\Controllers;

use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
    public function index()
    {
        return Inertia::render('PersonalInfo/Index', [
            'info' => PersonalInfo::first(),
        ]);
    }

    public function edit()
    {
        return Inertia::render('PersonalInfo/Edit', [
            'info' => PersonalInfo::first(),
        ]);
    }

    public function update(Request $request)
    {
        $info = PersonalInfo::first() ?? new PersonalInfo();

        $data = $request->validate([
            'full_name'    => 'required|string|max:255',
            'title'        => 'required|string|max:255',
            'bio'          => 'nullable|string',
            'email'        => 'required|email',
            'phone'        => 'nullable|string|max:255',
            'location'     => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
            'linkedin'     => 'nullable|url',
            'github'       => 'nullable|url',
            'twitter'      => 'nullable|url',
            'profile_photo'=> 'nullable|image|max:5120',
            'cv_path'      => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Upload photo
        if ($request->hasFile('profile_photo')) {
            if ($info->profile_photo) {
                Storage::disk('public')->delete($info->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profile', 'public');
        }

        // Upload CV
        if ($request->hasFile('cv_path')) {
            if ($info->cv_path) {
                Storage::disk('public')->delete($info->cv_path);
            }
            $data['cv_path'] = $request->file('cv_path')->store('cv', 'public');
        }

        $info->fill($data)->save();

        return redirect()->route('personal.index')->with('success', 'Informations personnelles mises à jour.');
    }
}
