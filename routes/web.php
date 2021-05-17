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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'user/{user:id}', 'as' => 'user.', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/profile_image', ['as' => 'profile_image', 'uses' => 'ImageController@showUserImage']);
    Route::get('/info', ['as' => 'info', 'uses' => 'UserController@show']);

    Route::get('/publications', ['as' => 'publications', 'uses' => 'UserController@showPublications']);
    Route::get('/publications/create', ['as' => 'publication.create', 'uses' => 'PublicationController@create']);

    Route::patch('/info/update', ['as' => 'info.update', 'uses' => 'UserController@updateInfo']);
    Route::patch('/password/update', ['as' => 'password.update', 'uses' => 'UserController@updatePassword']);

    Route::delete('/delete', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
});

Route::group(['prefix' => 'publication/{publication:id}', 'as' => 'user.', 'namespace' => 'App\Http\Controllers'], function () {
});
