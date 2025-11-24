<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'type',
        'status',
        'client',
        'context',
        'duration',
        'role',
        'project_url',
        'github_url',
        'order',
        'main_image',
        'gallery',
        'realisation_date',
    ];

    protected $casts = [
        'gallery' => 'array',
        'realisation_date' => 'date',
        'order' => 'integer',
    ];

    // Relations
    public function technologies()
    {
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }

    // Accessor image principale
    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('storage/'.$this->main_image) : null;
    }

    // Accessor galerie
    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery) return [];

        return collect($this->gallery)
            ->map(fn($img) => asset('storage/'.$img))
            ->toArray();
    }

    // Slug auto-généré
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
