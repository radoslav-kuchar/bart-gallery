<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('gallery.index');
});

Route::get('/gallery', 'GalleryController@index')->name('gallery.index');
Route::post('/gallery', 'GalleryController@store');
Route::get('/gallery/{slug}', 'GalleryController@show');
Route::post('/gallery/{gallery}', 'ImageController@store');

Route::delete('/gallery/{id}', 'GalleryController@destroy');
Route::delete('/image/{id}', 'ImageController@destroy');

Route::get('/images/{w}x{h}/{slug}/{filename}', 'ImageController@show');