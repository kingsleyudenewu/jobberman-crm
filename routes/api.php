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

Route::group(['prefix' => 'v1'],function(){
    Route::group(['prefix' => 'users'],function(){
        Route::post('/auth/login', 'AuthController@adminLogin')->name('admin.login');
    });

    Route::group(['prefix' => 'companies'],function(){
        Route::post('/auth/login', 'AuthController@companyLogin')->name('company.login');
    });

    Route::group(['prefix' => 'employees'],function(){
        Route::post('/auth/login', 'AuthController@employeeLogin')->name('employee.login');
    });
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
    Route::get('/companies', 'CompanyController@index')->name('company.index');
    Route::get('/companies/{company}', 'CompanyController@show')->name('company.show');
});
