<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    //
    function get_Repeated_data()
    {
        $alluser =   Photo::select('hash_value', DB::raw('COUNT(hash_value) as Repeated'))
        ->groupBy('hash_value')
        ->havingRaw('COUNT(hash_value) > 1')
        ->get();

        return response()->json(
            ['Repeated_photos' => $alluser]);


    }

    function get_all_data()
    {
        $allusers = Photo::all();
        return response()->json(
            ['photos' => $allusers ]);
    }

    function get_all_repeated_data(Request $request)
    {
        $request->validate([
            'hash_value' => 'required|string'
        ]);

        // Retrieve the 'email' and 'password' values from the request
        $desiredHash = $request->input('hash_value');

        $photos = Photo::where('hash_value', $desiredHash)->get();
        return response()->json(
            ['photos' => $photos ]);
    }

    function get_single_data(Request $request)
    {
        $request->validate([
            'hash_value' => 'required|string'
        ]);

        // Retrieve the 'email' and 'password' values from the request
        $desiredHash = $request->input('hash_value');
        $path = Photo::where('hash_value', $desiredHash)->select('relative_path')->first();
        // return response()->json(
        //     ['photo_path' => $path ]);
        return $path;

    }


    function delete_repeated_data(Request $request)
    {
        $request->validate([
            'PhotoIds' => 'required'
        ]);

        // Retrieve the 'email' and 'password' values from the request
        $valuesToDelete = $request->input('PhotoIds');
        Photo::whereIn('id', $valuesToDelete)->delete();

        return response()->json(
            ['response' => "Photo Deleted" ]);
    }



}
