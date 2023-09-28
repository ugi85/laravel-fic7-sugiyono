<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function UploadImage (Request $request)
    {
        $image = $request->image;
        $namaFile = time().'.'. $image->getClientOriginalExtension();
        $path = public_path('upload/images');
        $image->move($path, $namaFile);

        return response()->json([
            'image_path' => 'upload/image'. $namaFile,
            'base_url' => url('/'),
        ]);
    }
}
