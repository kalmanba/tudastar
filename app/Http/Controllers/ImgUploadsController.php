<?php

namespace App\Http\Controllers;
use App\Models\ImgUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImgUploadsController extends Controller
{
    public function list() {
        $images = ImgUpload::all()->sortByDesc('created_at');
        
        return view('imgDash', compact('images')); 
    }

    public function upload(Request $request) {
        $data = request()->validate([
            'image' => ['required', 'image']
        ]);

        $filePath = $data['image']->store('images', 'public');


        $newImage = new ImgUpload();
        $newImage->imgPath = $filePath;
        $newImage->save();

        $images = ImgUpload::all()->sortByDesc('created_at');
        $topImage = $images->first()->imgPath;


        return view('imgDash', compact('images', 'topImage'));
    }

    public function delete(Request $request) {

        $data = request()->validate([
            'id' => 'required'
        ]);

        $id = $data['id'];

        $oldImage = ImgUpload::find(id: $id);
        $oldPath = storage_path('app/public/' . $oldImage['imgPath']);
        
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $oldImage->delete();

        $images = ImgUpload::all()->sortByDesc('created_at');
        return view('imgDash', compact('images'));
    }
}