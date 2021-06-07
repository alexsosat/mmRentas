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

Route::get('/about', function () {
    return view('about');
})->name("about");


Route::group(['prefix' => 'user/{user:id}', 'as' => 'user.', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/profile_image', ['as' => 'profile_image', 'uses' => 'ImageController@showUserImage']);
    Route::get('/info', ['as' => 'info', 'uses' => 'UserController@show']);
    Route::get('/publications', ['as' => 'publications', 'uses' => 'UserController@showPublications']);


    Route::patch('/info/update', ['as' => 'info.update', 'uses' => 'UserController@updateInfo']);
    Route::patch('/password/update', ['as' => 'password.update', 'uses' => 'UserController@updatePassword']);
    Route::patch('/contact/update', ['as' => 'contact.update', 'uses' => 'UserController@updateContactInfo']);

    Route::delete('/delete', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
});

Route::group(['prefix' => 'publication', 'as' => 'publication.', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/create', ['as' => 'create', 'uses' => 'PublicationController@create']);
    Route::post('/store', ['as' => 'store', 'uses' => 'PublicationController@store']);

    Route::prefix('/{publication:id}')->group(function () {
        Route::get('/details', ['as' => 'details', 'uses' => 'PublicationController@show']);
        Route::get('/thumbnail', ['as' => 'profile_image', 'uses' => 'ImageController@showPublicationThumbnail']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'PublicationController@edit']);

        Route::get('/image/{image:id}', ['as' => 'image', 'uses' => 'ImageController@showPublicationImage']);

        Route::patch('/update', ['as' => 'update', 'uses' => 'PublicationController@update']);

        Route::delete('/delete', ['as' => 'destroy', 'uses' => 'PublicationController@destroy']);
        Route::delete('/images/delete', ['as' => 'images.all.destroy', 'uses' => 'PublicationController@destroyAllImages']);
        Route::delete('/image/{image:id}/delete', ['as' => 'image.destroy', 'uses' => 'PublicationController@destroyPublicationImage']);
    });
});
