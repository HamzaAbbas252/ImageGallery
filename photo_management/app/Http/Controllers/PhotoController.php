<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function getfilesfromcshow($filename)
    {
            $path = "C:\\Users\\HP\\Desktop\\attempted\\photo\\{$filename}";

            // if (!file_exists($path)) {
            //     abort(404);
            // }

            // return response()->file($path);

        //    return ["path" => $path];
        return ["path" => $path];

    }


    public function show($filename)
{
    // //$path = Storage::disk('public')->path("photos\\{$filename}");

    // if (!file_exists($path)) {
    //     abort(404);
    // }

    // return response()->file($path);
    // // return ["path" => $path];
}


public function bigshow($filename)
{
     $filepath = str_replace('\\', '/', $filename);
     $path = storage_path("app/public/photos/{$filepath}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
}

}
