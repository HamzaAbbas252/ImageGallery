<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FilesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    });

    Route::post("/viewphoto"  ,[GalleryController::class,"get_single_data"]);
    Route::get("/Gallery"  ,[GalleryController::class,"get_all_data"]);
    Route::get("/Repeated"  ,[GalleryController::class,"get_Repeated_data"]);
    Route::post("/AllRepeatedData"  ,[GalleryController::class,"get_all_repeated_data"]);
    Route::post("/DeleteRepeatedData"  ,[GalleryController::class,"delete_repeated_data"]);
    Route::post("/LoginUser"  ,[UserController::class,"handle_user_logins"]);



Route::post("/RegisterUser"  ,[AuthController::class,"register" ]);
Route::post("/AuthUser"  ,[AuthController::class,"login" ]);
Route::post("/logouts"  ,[AuthController::class,"logout" ])->middleware('auth:sanctum');


Route::get("/lsa"  ,[FilesController::class,"listAllPhotos" ]);
Route::get("/lsf"  ,[FilesController::class,"listAllDirectories" ]);

Route::post("/Galleryview"  ,[FilesController::class,"ViewPicture" ]);
Route::post("/GalleryDelete"  ,[FilesController::class,"deleteFile" ]);

Route::post("/GalleryCopy"  ,[FilesController::class,"copyFile" ]);
Route::post("/GalleryMove"  ,[FilesController::class,"moveFile" ]);

Route::post("/GalleryHardlink"  ,[FilesController::class,"createHardLink" ]);
Route::post("/GallerySoftlink"  ,[FilesController::class,"createSymbolicLink" ]);

