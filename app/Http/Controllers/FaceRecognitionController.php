<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaceRecognitionController extends Controller
{
    //

    public function index()
    {
        return view ('admins.FaceScan.index');
    }

    public function saveImage(Request $request)
    {
        $imageData = $request->input('image');

        // Decode data URL to get raw image data
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);

        // Generate unique filename
        $filename = 'image_' . time() . '.png';

        // Save image to the public directory
        file_put_contents(public_path('assets/image/' . $filename), $imageData);

        // Implement your additional business logic here

        // Return the path for further use (you can customize the response)
        return response()->json(['path' => 'assets/image/' . $filename]);
    }
}
