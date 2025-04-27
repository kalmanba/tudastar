<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Study_guide extends Model
{
    use HasFactory;

    public function study_guide() {
        return $this->belongsTo(study_guide::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

    protected static function booted()
    {
        static::creating(function ($study_guide) {
            $slug = Str::slug($study_guide->title);
            $originalSlug = $slug;
            $counter = 1;
        
            while (study_guide::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        
            $study_guide->slug = $slug;
        });

        static::updating(function ($study_guide) {
            if ($study_guide->isDirty('title')) {
                $slug = Str::slug($study_guide->title);
                $originalSlug = $slug;
                $counter = 1;
            
                while (study_guide::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }
            
                $study_guide->slug = $slug;
            }
        });
    }
}
