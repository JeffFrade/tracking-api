<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', 'PackageController@index')->name('package.index');
        Route::post('/store', 'PackageController@store')->name('package.store');
        Route::get('/show/{id}', 'PackageController@show')->name('package.show');
        Route::put('/update/{id}', 'PackageController@update')->name('package.update');
        Route::delete('/delete/{id}', 'PackageController@delete')->name('package.delete');
    });

    Route::group(['prefix' => 'status'], function () {
        Route::get('/', 'StatusController@index')->name('status.index');
        Route::post('/store', 'StatusController@store')->name('status.store');
        Route::get('/show/{id}', 'StatusController@show')->name('status.show');
        Route::put('/update/{id}', 'StatusController@update')->name('status.update');
        Route::delete('/delete/{id}', 'StatusController@delete')->name('status.delete');
    });

    Route::group(['prefix' => 'package-status'], function () {
        Route::get('/', 'PackageStatusController@index')->name('package.status.index');
    });
});
