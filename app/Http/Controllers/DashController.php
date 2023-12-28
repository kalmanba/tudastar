<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Study_guide;


class DashController extends Controller
{
    public function index() {
        return view('dash');
    }
    public function upload(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'image' => ['required', 'url'],
            'file' => ['required', 'mimetypes:application/pdf'],
            'subject' => 'required',
            'grade' => 'required'
        ]);

        $filePath = $request->file('file')->store('uploads', 'public');

        $newStudyGuide = new Study_guide();

        // Set the values for the new row
        $newStudyGuide->title = $data['name'];
        $newStudyGuide->content = $filePath;
        $newStudyGuide->imageLink = $data['image'];
        $newStudyGuide->subject_id = $data['subject']; // Replace $subjectId with the actual subject ID
        $newStudyGuide->grade_id = $data['grade']; // Replace $gradeId with the actual grade ID

        // Save the new record to the database
        $newStudyGuide->save();

        return redirect('dash');

    }

}
