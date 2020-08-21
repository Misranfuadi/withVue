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


//---Auth
Route::post('app/login','Admin\AuthController@login');
Route::get('/logout','Admin\AuthController@logout');
Route::get('/','Admin\AuthController@index');
//---Tag Controller
Route::get('app/dataTag','Admin\TagController@dataTag');
Route::post('app/createTag','Admin\TagController@store');
Route::post('app/updateTag','Admin\TagController@update');
Route::delete('app/deleteTag','Admin\TagController@destroy');

//---Category Controller
Route::get('app/dataCategory','Admin\CategoryController@dataCategory');
Route::post('app/createCategory','Admin\CategoryController@store');
Route::post('app/updateCategory','Admin\CategoryController@update');
Route::delete('app/deleteCategory','Admin\CategoryController@destroy');
Route::post('app/uploadImageCategory','Admin\CategoryController@uploadImage');
Route::delete('app/deleteImageCategory','Admin\CategoryController@deleteImage');

//--User Controller
Route::get('app/dataUser','Admin\UserController@dataUser');
Route::post('app/createUser','Admin\UserController@store');
Route::post('app/updateUser','Admin\UserController@update');
Route::delete('app/deleteUser','Admin\UserController@destroy');

Route::any('{slug}','Admin\AuthController@index');
