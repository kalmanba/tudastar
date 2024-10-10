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
        Schema::create('study_guides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content')->nullable();
            $table->string('imageLink');
            $table->string('subject_id');
            $table->string('grade_id');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_guides');
    }
};
