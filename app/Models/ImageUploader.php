<?php

namespace App\Models;

class ImageUploader
{

    public function upload($request, $dirPath)
    {
        $file = $request->image;
        $imageName = bin2hex(random_bytes(10)) . '.' . $request->file('image')->getClientOriginalExtension();
        $containerPath = public_path() . $dirPath;
        $file->move($containerPath, $imageName);
        return $dirPath . $imageName;
    }

}
