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
Route::any('/search', 'ItemsController@search');
Route::get('/category/{name}', ['uses' =>'ItemsController@category']);
Route::get('/product/{id}', ['uses' =>'ItemsController@product']);
Route::get('/', 'ItemsController@index');
