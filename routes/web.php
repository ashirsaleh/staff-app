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

Route::get('/pages', function () {
    return view('pages/doctors');
});

Route::get('doctors', 'DoctorController@index')->name('show-doctors');

Route::get('add-doctor', 'DoctorController@create')->name('add-doctor');
Route::post('add-doctor', 'DoctorController@store');

Route::get('profile', 'DoctorController@show')->name('show-profile');

Route::get('edit-profile', 'DoctorController@edit')->name('edit-profile');
Route::post('edit-profile', 'DoctorController@');