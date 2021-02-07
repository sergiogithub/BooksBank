<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('/bookshelf/address', 'Bookshelf\GeolocationController@getAddress');//sc88: this need to be changed, Bookshelf is the wrong api
    Route::post('/bookshelf/geolocation', 'Bookshelf\GeolocationController@getGeolocation');//sc88: this need to be changed, Bookshelf is the wrong api
    Route::get('/bookshelf/bookshelf_item/{id}', 'Bookshelf\ManagementController@getByBookshelfItemId');
    Route::get('/bookshelf/{type}/{text}', 'Bookshelf\SearchController@index');
    Route::post('/bookshelf/store', 'Bookshelf\ManagementController@store');
    Route::delete('/bookshelf/remove/{id}', 'Bookshelf\LibraryController@remove');
    

    Route::get('/library/{latitude}/{longitude}/{radius}', 'Library\SearchController@index');

    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
