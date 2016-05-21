<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// CORS
header('Access-Control-Allow-Origin: nginx/1.9.14');
header('Access-Control-Allow-Credentials: true');

Route::get('/', function () {
    return view('index');
});

Route::get('/api/v1/companies/{id?}', 'Companies@index');
Route::post('/api/v1/companies', 'Companies@store');
Route::post('/api/v1/companies/{id}', 'Companies@update');
Route::delete('/api/v1/companies/{id}', 'Companies@destroy');

Route::get('/api/v1/employees/{id?}', 'Employees@index');
Route::post('/api/v1/employees', 'Employees@store');
Route::post('/api/v1/employees/{id}', 'Employees@update');
Route::delete('/api/v1/employees/{id}', 'Employees@destroy');


Route::group(['middleware' => ['api','cors'],'prefix' => 'api'], function () {

    Route::post('register', 'APIController@register');

    Route::post('login', 'APIController@login');

    Route::group(['middleware' => 'jwt-auth'], function () {

        Route::post('get_user_details', 'APIController@get_user_details');

    });

});
Route::auth();

Route::get('/home', 'HomeController@index');
