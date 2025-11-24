<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'level',
        'color',
        'order',
        'logo',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Relation many-to-many avec Project
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    // Accessor : URL complète du logo
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/'.$this->logo) : null;
    }
}
