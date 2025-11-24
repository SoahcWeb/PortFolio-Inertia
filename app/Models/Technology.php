<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Technology extends Model
{
    use HasFactory;

    /**
     * Colonnes mass assignables
     */
    protected $fillable = [
        'name',
        'category',
        'level',
        'logo',
        'color',
        'order',
    ];

    /**
     * Relation Many-to-Many avec les projets
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Accessor : retourne l'URL complète du logo
     */
    public function getLogoPathAttribute()
    {
        return $this->logo
            ? Storage::url($this->logo)
            : null;
    }
}
