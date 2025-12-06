<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'job_title',      // nom cohérent avec le formulaire
        'bio',
        'profile_photo',
        'email',
        'phone',
        'location',
        'availability',
        'cv',             // nom cohérent avec le formulaire
        'linkedin',
        'github',
        'twitter',
    ];

    // Accessor : URL photo profil
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo ? asset('storage/'.$this->profile_photo) : null;
    }

    // Accessor : URL du CV
    public function getCvUrlAttribute()
    {
        return $this->cv ? asset('storage/'.$this->cv) : null;
    }
}
