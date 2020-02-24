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

use Illuminate\Http\Request;

Route::get('/', 'MainController@index');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/logout', 'AdminController@logout');
    Route::post('/admin/delete-file', 'AdminController@deleteFile');

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

    //Reviews
    Route::get('/admin/reviews', 'ReviewController@index');
    Route::get('/admin/reviews/create', 'ReviewController@create');
    Route::post('/admin/reviews', 'ReviewController@store');
    Route::get('/admin/reviews/{review}/edit', 'ReviewController@edit');
    Route::put('/admin/reviews/{review}', 'ReviewController@update');
    Route::get('/admin/reviews/{review}/delete', 'ReviewController@destroy');

    //Gallery
    Route::get('/admin/gallery', 'GalleryController@index');
    Route::get('/admin/gallery/create', 'GalleryController@create');
    Route::post('/admin/gallery', 'GalleryController@store');
    Route::get('/admin/gallery/{image}/edit', 'GalleryController@edit');
    Route::put('/admin/gallery/{image}', 'GalleryController@update');
    Route::get('/admin/gallery/{image}/delete', 'GalleryController@destroy');
});

Route::post('/admin/login', 'AdminController@auth');
Route::get('/admin/login', 'AdminController@login');