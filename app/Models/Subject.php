<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subject extends Model
{
    use HasFactory;

    public function study_guide() {
        return $this->hasMany(Study_guide::class);
    }

    protected static function booted()
    {
        static::creating(function ($subject) {
            $slug = Str::slug($subject->name);
            $originalSlug = $slug;
            $counter = 1;
        
            while (Subject::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        
            $subject->slug = $slug;
        });

        static::updating(function ($subject) {
            if ($subject->isDirty('name')) {
                $slug = Str::slug($subject->name);
                $originalSlug = $slug;
                $counter = 1;
            
                while (Subject::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }
            
                $subject->slug = $slug;
            }
        });
    }

}
