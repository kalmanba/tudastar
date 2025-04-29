<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study_guide;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\ZipArchive;

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
            ->orderByRaw('category IS NULL DESC, category ASC')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('category');


        if ($studyGuides->isNotEmpty()) {
            return view('app.list-guides')->with(['studyGuides' => $studyGuides, 'grade' => $grade, 'subject' => $subject, 'subjectid' => $data['subject_id']]);

        } else {
            session()->flash('showModal', true);
            session()->flash('subject', $subject);
            session()->flash('grade', $grade);
            return redirect('/');
        }

    }

    public function listBySlug($subject, $grade) {
        $subject = Subject::where('slug' , $subject)->first();
        $grade = Grade::where('slug' , $grade)->first();

        $studyGuides = Study_guide::where('subject_id', $subject->id)
            ->where('grade_id', $grade->id)
            ->orderByRaw('category IS NULL DESC, category ASC')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('category');


        if ($studyGuides->isNotEmpty()) {
            return view('app.list-guides')->with(['studyGuides' => $studyGuides, 'grade' => $grade, 'subject' => $subject]);

        } else {
            session()->flash('showModal', true);
            session()->flash('subject', $subject->name);
            session()->flash('grade', $grade->grade);
            return redirect('/');
        }
    }

    public function view(Study_guide $study_guide) {

        $subject = Subject::find($study_guide['subject_id']);

        $grade = Grade::find($study_guide['grade_id']);

        // Check if file has HTML, if it has load into variable, covert to UTF-8, return required variables to view
        if ($study_guide['docx'] != '') {
            $docxPath = '/app/public/' . $study_guide['docx'];

            $fileContents = File::get(storage_path($docxPath));
            $fileContents = mb_convert_encoding($fileContents, 'UTF-8', ['windows-1252', 'UTF-8']);

        } else {
            $fileContents = "";

        }
        return view('app.view')->with(['study_guide' => $study_guide, 'grade' => $grade, 'subject' => $subject, 'fileContents' => $fileContents]);

    }

    public function viewBySlug($subject, $grade, $guide) {
        $subject = Subject::where('slug' , $subject)->first();
        $grade = Grade::where('slug' , $grade)->first();

        $study_guide = Study_guide::where('slug', $guide)->first();

        // Check if file has HTML, if it has load into variable, covert to UTF-8, return required variables to view
        if ($study_guide['docx'] != '') {
            $docxPath = '/app/public/' . $study_guide['docx'];

            $fileContents = File::get(storage_path($docxPath));
            $fileContents = mb_convert_encoding($fileContents, 'UTF-8', ['windows-1252', 'UTF-8']);

        } else {
            $fileContents = "";

        }

        return view('app.view')->with(['study_guide' => $study_guide, 'grade' => $grade, 'subject' => $subject, 'fileContents' => $fileContents]);
    }

    public function editview(Request $request) {
        $data = request()->validate([
            'guide_id' => 'required'
        ]);

        $studyGuide = Study_guide::find($data['guide_id']);
        $subjects = Subject::all();
        $grades = Grade::all();
        $firstSubject = Subject::find($studyGuide->subject_id);
        $firstGrade = Grade::find($studyGuide->grade_id);

        return view('editview', compact('studyGuide', 'subjects', 'grades', 'firstSubject', 'firstGrade'));
    }
    public function edit(Request $request, $id) {
        $studyGuide = Study_guide::find($id);

        // TODO: Validate
        // Update the fields
        $studyGuide->title = $request->input('name');
        $studyGuide->imageLink = $request->input('image');
        $studyGuide->category = $request->input('category');
        $studyGuide->subject_id = $request->input('subject');
        $studyGuide->grade_id = $request->input('grade');

        // In case user wants, delete already stored pdf
        if (isset($request['delete_pdf'])) {
            $pdfPath = storage_path('app/public/' . $studyGuide['content']);
            if (File::exists($pdfPath)) {
                File::delete($pdfPath);

                $studyGuide->content = null;
            }
        }
        // In case user wants, delete already stored html
        if (isset($request['delete_htm'])) {
            $htmPath = storage_path('app/public/' . $studyGuide['docx']);
            if (File::exists($htmPath)) {
                File::delete($htmPath);

                $studyGuide->docx = null;
            }
        }

        // Handle updating the document pdf if provided
        // Deletes old, if exists, and save new
        if ($request->hasFile('file')) {
            $oldfilePath = storage_path('app/public/' . $studyGuide['content']);

            // Check if the file exists before deleting
            if (File::exists($oldfilePath)) {
                File::delete($oldfilePath);

                $filePath = $request->file('file')->store('uploads', 'public');
                $studyGuide->content = $filePath;
                $studyGuide->save();
            }
        }

        // Handle updating the document pdf if provided
        // Deletes old, if exists, and save new
        if ($request->hasFile('docx')) {
            $oldfilePath = storage_path('app/public/' . $studyGuide['docx']);

            // Check if the file exists before deleting
            if (File::exists($oldfilePath)) {

                File::delete($oldfilePath);

                $filePath = $request->file('docx')->store('uploads', 'public');
                $studyGuide->docx = $filePath;
                $studyGuide->save();
            }
        }
        // This is needed to write to database in the case of no change in the files
        $studyGuide->save();
        return redirect('/view-guide/'. $id);
    }
    public function delete($id) {
        $studyGuide = Study_guide::find($id);


        // Delete the associated files (if needed)
        $contentPath = storage_path('app/public/' . $studyGuide['content']);
        $docxPath = storage_path('app/public/' . $studyGuide['docx']);

        // In case pdf exists, it deletes it before deleting whole db entry
        if (File::exists($contentPath)) {
            File::delete($contentPath);
        }

        // In case html exists, it deletes it before deleting whole db entry
        if (File::exists($docxPath)) {
            File::delete($docxPath);
        }
        $studyGuide->delete();

        //TODO: implement proper error handling
        return redirect('/dash?delok');
    }

}
