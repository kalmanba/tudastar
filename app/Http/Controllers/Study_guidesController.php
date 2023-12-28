<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study_guide;
use App\Models\Grade;
use App\Models\Subject;
class Study_guidesController extends Controller
{
    public function list(Request $request) {
        $data = request()->validate([
            'subject_id' => 'required',
            'grade_id' => 'required'
        ]);

        $subject = Subject::find($data['subject_id']);
        $subject = $subject->name;

        $grade = Grade::find($data['grade_id']);
        $grade = $grade->grade;

        $studyGuides = Study_guide::where('subject_id', $data['subject_id'])
            ->where('grade_id', $data['grade_id'])
            ->get();

        if ($studyGuides->isNotEmpty()) {
            return view('app.list-guides')->with(['studyGuides' => $studyGuides, 'grade' => $grade, 'subject' => $subject, 'subjectid' => $data['subject_id']]);

        } else {
            session()->flash('showModal', true);
            session()->flash('subject', $subject);
            session()->flash('grade', $grade);
            return redirect('/');
        }

    }
    public function view(Study_guide $study_guide) {

        $subject = Subject::find($study_guide['subject_id']);
        $subject = $subject->name;

        $grade = Grade::find($study_guide['grade_id']);
        $grade = $grade->grade;

        return view('app.view')->with(['study_guide' => $study_guide, 'grade' => $grade, 'subject' => $subject]);;
    }

}
