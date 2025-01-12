<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Study_guide;
use Psr\Log\NullLogger;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class DashController extends Controller
{
    public function index() {
        return view('dash');
    }
    public function upload(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'image' => ['required', 'url'],
            'category' => '',
            'file' => ['mimetypes:application/pdf'],
            'docx' => 'mimetypes:text/html',
            'subject' => 'required',
            'grade' => 'required'
        ]);

        //If the request has an attached file (or both), save the guide
        // TODO: Implement proper error handling
        if($request->hasFile('file') || $request->hasFile('docx')){

            $newStudyGuide = new Study_guide(); //Start writing into database

            // In case request has pdf, save pdf
            if ($request->hasFile('file')){
                $filePath = $request->file('file')->store('uploads', 'public');
                $newStudyGuide->content = $filePath;
            }

            // In case request has htm file, save html
            if ($request->hasFile('docx')){
                $docxPath = $request->file('docx')->store('uploads', 'public');
                $newStudyGuide->docx = $docxPath;
            }

            // Set the values for the new row
            $newStudyGuide->title = $data['name'];
            $newStudyGuide->imageLink = $data['image'];
            $newStudyGuide->category = $data['category'];
            $newStudyGuide->subject_id = $data['subject']; // Replace $subjectId with the actual subject ID
            $newStudyGuide->grade_id = $data['grade']; // Replace $gradeId with the actual grade ID

            // Save the new record to the database
            $newStudyGuide->save();
            // Todo: redirect to created guide
            return redirect('dash?ok');

        } else {
            return redirect('/dash?error'); // No file attached, go back with error
        }



    }
    public function releaseUpgrade() {
        $output = shell_exec("sudo /bin/bash /var/www/learn.honaphire.net/upgrade.sh");
        echo $output;
    }

}
