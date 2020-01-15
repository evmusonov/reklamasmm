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

    Route::get('/admin/menu', 'MenuController@index');
    Route::get('/admin/menu/create', 'MenuController@create');
    Route::post('/admin/menu', 'MenuController@store');
    Route::get('/admin/menu/{menu}/edit', 'MenuController@edit');
    Route::put('/admin/menu/{menu}', 'MenuController@update');
    Route::get('/admin/menu/{menu}/delete', 'MenuController@destroy');
});

Route::post('/admin/login', 'AdminController@auth');
Route::get('/admin/login', 'AdminController@login');
