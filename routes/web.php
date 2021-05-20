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


    Route::patch('/info/update', ['as' => 'info.update', 'uses' => 'UserController@updateInfo']);
    Route::patch('/password/update', ['as' => 'password.update', 'uses' => 'UserController@updatePassword']);

    Route::delete('/delete', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
});

Route::group(['prefix' => 'publication', 'as' => 'publication.', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/publication/create', ['as' => 'create', 'uses' => 'PublicationController@create']);
    Route::post('/store', ['as' => 'store', 'uses' => 'PublicationController@store']);

    Route::prefix('/{publication:id}')->group(function () {
        Route::get('/details', ['as' => 'details', 'uses' => 'PublicationController@show']);
        Route::get('/thumbnail', ['as' => 'profile_image', 'uses' => 'ImageController@showPublicationThumbnail']);

        Route::patch('/edit', ['as' => 'edit', 'uses' => 'PublicationController@edit']);

        Route::delete('/delete', ['as' => 'delete', 'uses' => 'PublicationController@destroy']);
    });
});
