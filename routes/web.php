<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', '\App\Http\Controllers\HomeController@index')->name('map');

Route::get('import', '\App\Http\Controllers\HomeController@import')->name('import');
Route::post('importSave', '\App\Http\Controllers\HomeController@importSave')->name('importSave');

Route::get('clearLocation', '\App\Http\Controllers\HomeController@clearLocation')->name('clearLocation');

Route::get('update_markers', '\App\Http\Controllers\HomeController@updateMarkersFile')->name('update_markers');
Route::post('changeMarkersFile', '\App\Http\Controllers\HomeController@changeMarkersFile')->name('changeMarkersFile');

Route::get('downloadMarkers', '\App\Http\Controllers\HomeController@downloadMarkers')->name('downloadMarkers');
