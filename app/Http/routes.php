<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('user', 'User@index');
Route::get('user/validateform', 'User@validateform');
Route::post('user/validateform', 'User@validateform');
Route::get('user/my_account', 'User@my_account');
Route::get('user/login', 'User@login');
Route::post('user/validateform', 'User@validateform');
Route::get('user/login_validate_form', 'User@login_validate_form');
Route::post('user/login_validate_form', 'User@login_validate_form');
Route::get('user/logout', 'User@logout');
Route::get('user/image_upload', 'User@image_upload');
Route::post('user/image_upload', 'User@image_upload');
Route::get('/image', 'User@logout');
