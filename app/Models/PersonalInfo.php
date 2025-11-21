<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','title','bio','photo','email','phone','location','available','cv','socials'
    ];

    protected $casts = [
        'socials' => 'array',
        'available' => 'boolean'
    ];
}
