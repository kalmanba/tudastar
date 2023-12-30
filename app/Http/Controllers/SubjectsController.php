<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use DateTime;

use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {

        $now = new DateTime('now');
        $start = new DateTime('2023-12-31 23:59:59');
        $end = new DateTime('2024-01-01 09:00:00');

        if ($now >= $start && $now <= $end) {
            session()->flash('showcd', true);
        }

        $subjects = Subject::all(); // Fetch all subjects from the database
        return view('home', compact('subjects'));
    }
}
