<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study_guide extends Model
{
    use HasFactory;

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
