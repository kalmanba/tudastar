<?php

namespace App\Http\Controllers;
use App\Models\Subject;

use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::all(); // Fetch all subjects from the database
        return view('home', compact('subjects'));
    }
}
