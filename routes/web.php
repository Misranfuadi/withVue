<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your lication. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//---Login
Route::post('app/login','Admin\AuthController@login');

Route::group(['prefix' => 'app','middleware'=> 'admin'], function () {


    //---Tag Controller
    Route::get('/dataTag','Admin\TagController@dataTag');
    Route::post('/createTag','Admin\TagController@store');
    Route::post('/updateTag','Admin\TagController@update');
    Route::delete('/deleteTag','Admin\TagController@destroy');

    //---Category Controller
    Route::get('/dataCategory','Admin\CategoryController@dataCategory');
    Route::post('/createCategory','Admin\CategoryController@store');
    Route::post('/updateCategory','Admin\CategoryController@update');
    Route::delete('/deleteCategory','Admin\CategoryController@destroy');
    Route::post('/uploadImageCategory','Admin\CategoryController@uploadImage');
    Route::delete('/deleteImageCategory','Admin\CategoryController@deleteImage');

    //--User Controller
    Route::get('/dataUser','Admin\UserController@dataUser');
    Route::post('/createUser','Admin\UserController@store');
    Route::post('/updateUser','Admin\UserController@update');
    Route::delete('/deleteUser','Admin\UserController@destroy');
});



Route::get('/logout','Admin\AuthController@logout');
Route::get('/','Admin\AuthController@index');
Route::any('{slug}','Admin\AuthController@index');
