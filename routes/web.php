<?php

use App\Http\Controllers\PublicationController;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name("about");

Route::get('/email/verification/success', function () {
    return view('auth.verify_success');
})->name("email.success");

Route::get('/search', [PublicationController::class, 'index'])->name("search");
Route::get('/results', [PublicationController::class, 'search'])->name("results");


Route::group(['prefix' => 'user/{user:id}', 'as' => 'user.', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/profile_image', ['as' => 'profile_image', 'uses' => 'ImageController@showUserImage']);
    Route::get('/info', ['as' => 'info', 'uses' => 'UserController@show'])->middleware('auth', 'verified', 'restrictToId');
    Route::get('/publications', ['as' => 'publications', 'uses' => 'UserController@showPublications'])->middleware('auth', 'verified', 'restrictToId');


    Route::patch('/info/update', ['as' => 'info.update', 'uses' => 'UserController@updateInfo'])->middleware('auth', 'verified', 'restrictToId');
    Route::patch('/password/update', ['as' => 'password.update', 'uses' => 'UserController@updatePassword'])->middleware('auth', 'verified', 'restrictToId');
    Route::patch('/contact/update', ['as' => 'contact.update', 'uses' => 'UserController@updateContactInfo'])->middleware('auth', 'verified', 'restrictToId');

    Route::delete('/delete', ['as' => 'destroy', 'uses' => 'UserController@destroy'])->middleware('auth', 'verified', 'restrictToId');
});

Route::group(['prefix' => 'publication', 'as' => 'publication.', 'namespace' => 'App\Http\Controllers'], function () {

    Route::get('/create', ['as' => 'create', 'uses' => 'PublicationController@create'])->middleware('auth', 'verified');
    Route::post('/store', ['as' => 'store', 'uses' => 'PublicationController@store'])->middleware('auth', 'verified');

    Route::prefix('/{publication:id}')->group(function () {
        Route::get('/details', ['as' => 'details', 'uses' => 'PublicationController@show']);
        Route::get('/thumbnail', ['as' => 'profile_image', 'uses' => 'ImageController@showPublicationThumbnail']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'PublicationController@edit'])->middleware('auth', 'verified', 'publicationBelongsToUser');

        Route::get('/image/{image:id}', ['as' => 'image', 'uses' => 'ImageController@showPublicationImage']);

        Route::patch('/update', ['as' => 'update', 'uses' => 'PublicationController@update'])->middleware('auth', 'verified', 'publicationBelongsToUser');
        Route::patch('/pause', ['as' => 'pause', 'uses' => 'PublicationController@pause'])->middleware('auth', 'verified', 'publicationBelongsToUser');

        Route::delete('/delete', ['as' => 'destroy', 'uses' => 'PublicationController@destroy'])->middleware('auth', 'verified', 'publicationBelongsToUser');
        Route::delete('/images/delete', ['as' => 'images.all.destroy', 'uses' => 'PublicationController@destroyAllImages'])->middleware('auth', 'verified', 'publicationBelongsToUser');
        Route::delete('/image/{image:id}/delete', ['as' => 'image.destroy', 'uses' => 'PublicationController@destroyPublicationImage'])->middleware('auth', 'verified', 'publicationBelongsToUser');
    });
});
