<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','short_description','description','type','status','date','client','context','role','link','github','order','main_image'
    ];

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }
}
