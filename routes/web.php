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



Route::get('app/dataTag','Admin\TagController@dataTag' );
Route::post('app/createTag','Admin\TagController@store' );
Route::post('app/updateTag','Admin\TagController@update' );
Route::delete('app/deleteTag','Admin\TagController@destroy' );


Route::get('/', function () {
    return view('welcome');
});


Route::any('{slug}', function () {
    return view('welcome');
});
