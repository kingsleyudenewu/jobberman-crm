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

    Route::group(['prefix' => 'companies'], function(){
        Route::post('/auth/login', 'AuthController@companyLogin')->name('company.login');
        Route::group(['middleware' => ['auth:company', 'scopes:company']], function () {
//            Route::get('/{company}', 'CompanyController@show')->name('company.show');
            Route::get('/{company}/employees', 'CompanyController@viewEmployees')->name('company.employees');
        });

    });

    Route::group(['prefix' => 'employees'], function(){
        Route::post('/auth/login', 'AuthController@employeeLogin')->name('employee.login');
    });

    Route::get('/companies', 'CompanyController@index')->name('company.index')->middleware(['auth:api']);
    Route::get('/employees', 'EmployeeController@index')->name('employee.index');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
