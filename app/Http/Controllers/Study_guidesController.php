<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study_guide;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
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
    public function editview(Request $request) {
        $data = request()->validate([
            'guide_id' => 'required'
        ]);

        $studyGuide = Study_guide::find($data['guide_id']);
        return view('editview', compact('studyGuide'));
    }
    public function edit(Request $request, $id) {
        $studyGuide = Study_guide::find($id);

        // Update the fields
        $studyGuide->title = $request->input('name');
        $studyGuide->imageLink = $request->input('image');
        $studyGuide->subject_id = $request->input('subject');
        $studyGuide->grade_id = $request->input('grade');

        // Handle updating the document file if provided
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $studyGuide->content = $filePath;
        }

        $studyGuide->save();

        return redirect('/dash');
    }
    public function delete($id) {
        $studyGuide = Study_guide::find($id);

        $studyGuide = Study_guide::find($id);


        // Delete the associated file (if needed)
        // Note: Adjust this part based on how you store and manage files
        if (Storage::exists($studyGuide->content)) {
            Storage::delete($studyGuide->content);
        }

        $studyGuide->delete();

        return redirect('/dash');
    }

}
