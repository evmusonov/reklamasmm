<?php

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

Route::get('/', 'MainController@index');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/logout', 'AdminController@logout');

    //Menu
    Route::get('/admin/menu', 'MenuController@index');
    Route::get('/admin/menu/create', 'MenuController@create');
    Route::post('/admin/menu', 'MenuController@store');
    Route::get('/admin/menu/{menu}/edit', 'MenuController@edit');
    Route::put('/admin/menu/{menu}', 'MenuController@update');
    Route::get('/admin/menu/{menu}/delete', 'MenuController@destroy');

    //Infoblocks
    Route::get('/admin/infoblocks', 'InfoblockController@index');
    Route::get('/admin/infoblocks/create', 'InfoblockController@create');
    Route::post('/admin/infoblocks', 'InfoblockController@store');
    Route::get('/admin/infoblocks/{infoblock}/edit', 'InfoblockController@edit');
    Route::put('/admin/infoblocks/{infoblock}', 'InfoblockController@update');
    Route::get('/admin/infoblocks/{infoblock}/delete', 'InfoblockController@destroy');

    //Services
    Route::get('/admin/services', 'ServiceController@index');
    Route::get('/admin/services/create', 'ServiceController@create');
    Route::post('/admin/services', 'ServiceController@store');
    Route::get('/admin/services/{service}/edit', 'ServiceController@edit');
    Route::put('/admin/services/{service}', 'ServiceController@update');
    Route::get('/admin/services/{service}/delete', 'ServiceController@destroy');
});

Route::post('/admin/login', 'AdminController@auth');
Route::get('/admin/login', 'AdminController@login');
