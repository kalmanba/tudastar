<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });

        Schema::table('study_guides', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropUnique('subjects_slug_unique');
            $table->dropColumn('slug');
        });
        
        Schema::table('grades', function (Blueprint $table) {
            $table->dropUnique('grades_slug_unique');
            $table->dropColumn('slug');
        });

        Schema::table('study_guides', function (Blueprint $table) {
            $table->dropUnique('study_guides_slug_unique');
            $table->dropColumn('slug');
        });        
    }
};

/*
If you have extisting data in the database, run these tinker commands to give them a slug.

Study_guide::whereNull('slug')->chunk(100, function ($study_guides) {
    foreach ($study_guides as $study_guide) {
        $slug = Str::slug($study_guide->title);
        $originalSlug = $slug;
        $counter = 1;

        while (Study_guide::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $study_guide->slug = $slug;
        $study_guide->save();
    }
});

Grade::whereNull('slug')->chunk(100, function ($grades) {
    foreach ($grades as $grade) {
        $slug = Str::slug($grade->grade);
        $originalSlug = $slug;
        $counter = 1;
        while (Grade::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $grade->slug = $slug;
        $grade->save();
    }
});

Subject::whereNull('slug')->chunk(100, function ($subjects) {
    foreach ($subjects as $subject) {
        $slug = Str::slug($subject->name);
        $originalSlug = $slug;
        $counter = 1;

        while (Subject::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $subject->slug = $slug;
        $subject->save();
    }
});

*/