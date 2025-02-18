<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');

            // Resize image
            $resizedImage = Image::make($image)->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Save resized image to storage
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/' . $imageName;

            Storage::disk('public')->put($path, (string) $resizedImage->encode());

            return response()->json(['path' => $path, 'url' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'Upload failed'], 400);
    }
}