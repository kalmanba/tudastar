<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Grade extends Model
{
    use HasFactory;

    public function study_guide() {
        return $this->hasMany(Study_guide::class);
    }

    protected static function booted()
    {
        static::creating(function ($grade) {
            $slug = Str::slug($grade->grade);
            $originalSlug = $slug;
            $counter = 1;
        
            while (grade::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        
            $grade->slug = $slug;
        });

        static::updating(function ($grade) {
            if ($grade->isDirty('grade')) {
                $slug = Str::slug($grade->grade);
                $originalSlug = $slug;
                $counter = 1;
            
                while (grade::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }
            
                $grade->slug = $slug;
            }
        });
    }
    
}
