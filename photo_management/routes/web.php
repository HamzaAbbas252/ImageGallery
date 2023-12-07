<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Login', function () {
    return view('welcome');
});

Route::get('/newside', function () {
    return view('welcome');
});


Route::get('/Sidebar', function () {
    return view('welcome');
});


Route::get('/Main', function () {
    return view('welcome');
});

Route::get('/NewLoginForm', function () {
    return view('welcome');
});

Route::get('/Table', function () {
    return view('welcome');
});

Route::get('/Action', function () {
    return view('welcome');
});

Route::get('/Dailoged', function () {
    return view('welcome');
});

Route::get('/delete', function () {
    return view('welcome');
});


//Route::get('/photos/{filename}', [PhotoController::class, 'getfilesfromcshow'])->where('filename', '.*');
//Route::get('/photos/{filename}', [PhotoController::class, 'show'])->where('filename', '.*');
Route::get('/photos/{filename}', [PhotoController::class, 'bigshow'])->where('filename', '.*');



