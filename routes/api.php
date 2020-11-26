<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1/auth'], function () {
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::get('/companies', 'CompanyController@index')->name('company.index');
    Route::get('/companies/{company}', 'CompanyController@show')->name('company.show');
});
