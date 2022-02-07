<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('file')->store('images', 'public');
        $image = Image::make(public_path("storage/{$path}"))->fit(800, 450);
        $image->save();
        $imageDB = new \App\Models\Image();
        $imageDB->id_establishment = $request['uuid'];
        $imageDB->url = $path;
        $imageDB->save();
        return response()->json(['success' => true, 'path' => $path]);
    }

    public function destroy(Request $request)
    {
        $image = $request->get('image');
        if (File::exists('storage/' . $image)) {
            File::delete('storage/' . $image);
        }
        $imageDB = \App\Models\Image::where('url', $image)->firstOrFail();
        \App\Models\Image::destroy($imageDB->id);
        return response()->json([
            'success' => true,
            'image' => $image
        ]);
    }
}
