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

    Route::get('/info', ['as' => 'info', 'uses' => 'UserController@show']);
    Route::get('/profile_image', ['as' => 'profile_image', 'uses' => 'ImageController@showUserImage']);

    Route::patch('/info/update', ['as' => 'info.update', 'uses' => 'UserController@updateInfo']);
    Route::patch('/password/update', ['as' => 'password.update', 'uses' => 'UserController@updatePassword']);

    Route::delete('/delete', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
});
