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
        Route::group(['middleware' => ['auth:api', 'scopes:user']], function () {
            Route::get('/profile', 'AdminController@index')->name('admin.profile.index');
            Route::post('/profile/update', 'AdminController@update')->name('admin.profile.update');
        });
    });

    Route::group(['prefix' => 'companies'], function(){
        Route::post('/auth/login', 'AuthController@companyLogin')->name('company.login');
        Route::group(['middleware' => ['auth:company', 'scopes:company']], function () {
            Route::get('/profile', 'CompanyController@show')->name('company.profile.show');
        });

    });

    Route::group(['prefix' => 'employees'], function(){
        Route::post('/auth/login', 'AuthController@employeeLogin')->name('employee.login');
        Route::group(['middleware' => ['auth:company', 'scopes:employee']], function () {
            Route::get('/profile', 'EmployeeController@show')->name('employee.profile.show');
            Route::post('/profile/update/{employee}', 'EmployeeController@update')->name('employee.profile.update');
        });

    });

    Route::get('/companies', 'CompanyController@index')->name('company.index');
    Route::post('/profile/update/{company}', 'CompanyController@update')->name('company.profile.update')->middleware(['auth:api', 'scopes:user']);
    Route::get('/employees', 'EmployeeController@index')->name('employee.index');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
