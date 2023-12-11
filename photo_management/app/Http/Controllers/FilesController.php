<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\Return_;

class FilesController extends Controller
{
    public function listAllDirectories()
{
    $directory = 'public/photos';
    $allDirectories = $this->listDirectories($directory);

    // Remove duplicates from the list
    $uniqueDirectories = array_unique($allDirectories);

    return response()->json(['directories' => array_values($uniqueDirectories)]);
}

private function listDirectories($directory)
{
    $allDirectories = Storage::allDirectories($directory);
    $result = [];

    foreach ($allDirectories as $dir) {
        $result[] = $dir;
        $result = array_merge($result, $this->listDirectories($dir));
    }

    return $result;
}


    ////////////////////////////////////////////////////////////////////////////////////

    public function listAllPhotos()
{
    $directory = 'public/photos';
    $allPhotos = $this->listPhotos($directory);

    // Remove duplicates from the list
    $uniquePhotos = array_unique($allPhotos);

    return response()->json(['photos' => $uniquePhotos]);
}

private function listPhotos($directory)
{
    $allFiles = Storage::allFiles($directory);
    $photoExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Add more extensions if needed
    $result = [];

    foreach ($allFiles as $file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array(strtolower($extension), $photoExtensions)) {
            $result[] = $file;
        }
    }

    // Recursively get photos from subdirectories
    $allDirectories = Storage::allDirectories($directory);
    foreach ($allDirectories as $dir) {
        $result = array_merge($result, $this->listPhotos($dir));
    }

    return $result;
}
// copy files
public function copyFile(Request $request)
{
    $request->validate([
        'sourcePath'                  => ['required'],
        'destinationPath'             => ['required']
    ]);

    $sourcePath = $request->input('sourcePath');
    $destinationPath =($request->input('destinationPath'));

    $cleanedSourcePath =  basename($sourcePath);
    $string1 = $destinationPath;
    $string2 = '/';
    $string3 = $cleanedSourcePath;

    $FinalPath = $string1 . $string2 . $string3;

    try {
        // Copy the file
        Storage::copy($sourcePath, $FinalPath);

        return response()->json(['message' => 'File copied successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error copying file: ' . $e->getMessage()], 500);
    }
}

// move files

public function moveFile(Request $request)
{
    $request->validate([
        'sourcePath'                  => ['required'],
        'destinationPath'             => ['required']
    ]);

    $sourcePath = $request->input('sourcePath');
    $destinationPath =($request->input('destinationPath'));

    $cleanedSourcePath =  basename($sourcePath);
    $string1 = $destinationPath;
    $string2 = '/';
    $string3 = $cleanedSourcePath;

    $FinalPath = $string1 . $string2 . $string3;

    try {
        // Move the file
        Storage::move($sourcePath, $FinalPath);

        return response()->json(['message' => 'File moved successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error moving file: ' . $e->getMessage()], 500);
    }
}

public function deleteFile(Request $request)
{
    $request->validate([
        'filePath'                  => ['required']
    ]);

    $filePath = $request->input('filePath');


    try {
        // Delete the file
        Storage::delete($filePath);

        return response()->json(['message' => 'File deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error deleting file: ' . $e->getMessage()], 500);
    }

   // return $filePath;
}

// view

public function ViewPicture(Request $request)
{
    $request->validate([
        'filename'  => ['required']
    ]);
    $Fullpath = $request->input('filename');
    $filename = str_replace('public/', '', $Fullpath);

    $filepath = str_replace('\\', '/', $filename);
    $path = storage_path("app/public/{$filepath}");

    if (!file_exists($path)) {
        abort(404);
    }
    // return response()->file($path);
      return response()->json(['path' => $filepath ]);

}

///// /HARDLINK VS SYMLINK


public function createHardLink(Request $request)
    {
        $request->validate([
            'sourcePath'                  => ['required'],
            'destinationPath'             => ['required']
        ]);

        $sourcePath = $request->input('sourcePath');
        $destinationPath =($request->input('destinationPath'));

        $cleanedSourcePath =  basename($sourcePath);
        $string1 = $destinationPath;
        $string2 = '/';
        $string3 = $cleanedSourcePath;

        $FinalPath = $string1 . $string2 . $string3;


        // // Path to the original file
         $originalFilePath = storage_path($sourcePath);

        // Path for the hard link
        $hardLinkPath = storage_path($FinalPath);

        Storage::copy($originalFilePath, $hardLinkPath);
        // Create a hard link
        $this->createHardLinkHelper($originalFilePath, $hardLinkPath);

        return response()->json(['message' => 'Hard link created successfully']);


    }

    public function createSymbolicLink(Request $request)
    {

        $request->validate([
            'sourcePath'                  => ['required'],
            'destinationPath'             => ['required']
        ]);

        $sourcePath = $request->input('sourcePath');
        $destinationPath =($request->input('destinationPath'));

        $cleanedSourcePath =  basename($sourcePath);
        $string1 = $destinationPath;
        $string2 = '/';
        $string3 = $cleanedSourcePath;

        $FinalPath = $string1 . $string2 . $string3;

        // Path to the original file
        $originalFilePath = storage_path($sourcePath);

        // Path for the symbolic link
        $symbolicLinkPath = public_path($FinalPath);

       // Create a symbolic link
       Storage::copy($originalFilePath, $symbolicLinkPath);

        $this->createSymbolicLinkHelper($originalFilePath, $symbolicLinkPath);

        return response()->json(['message' => 'Symbolic link created successfully']);

    }

    protected function createHardLinkHelper($sourcePath, $targetPath)
    {
        // Check if the hard link already exists
        if (!file_exists($targetPath)) {
            // Create a hard link
            link($sourcePath, $targetPath);
        }
    }

    protected function createSymbolicLinkHelper($sourcePath, $targetPath)
    {
        // Check if the symbolic link already exists
        if (!file_exists($targetPath)) {
            // Create a symbolic link
            symlink($sourcePath, $targetPath);
        }
    }






}


