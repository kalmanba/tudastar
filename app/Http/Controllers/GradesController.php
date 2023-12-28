<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;

class GradesController extends Controller
{
    public function selector(Request $request) {
        $data = request()->validate([
            'subject_id' => 'required',
        ]);

        $subjectid = $data['subject_id'];

        $data = Subject::find($data['subject_id']);
        $subjectname = $data->name;



        $grades = Grade::all();
        return view('app.gradeselector')->with(['subjectid' => $subjectid, 'grades' => $grades, 'subjectname' => $subjectname]);
    }
}
