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


//---Tag Controller
Route::get('app/dataTag','Admin\TagController@dataTag' );
Route::post('app/createTag','Admin\TagController@store' );
Route::post('app/updateTag','Admin\TagController@update' );
Route::delete('app/deleteTag','Admin\TagController@destroy' );

//---Category Controller
Route::get('app/dataCategory','Admin\CategoryController@dataCategory' );
Route::post('app/createCategory','Admin\CategoryController@store' );
Route::post('app/updateCategory','Admin\CategoryController@update' );
Route::delete('app/deleteCategory','Admin\CategoryController@destroy' );
Route::post('app/uploadImageCategory','Admin\CategoryController@uploadImage' );
Route::delete('app/deleteImageCategory','Admin\CategoryController@deleteImage' );


Route::get('/', function () {
    return view('welcome');
});


Route::any('{slug}', function () {
    return view('welcome');
});
