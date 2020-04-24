<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TaskController@index')->name('index');
Route::get('/create', 'TaskController@create')->name('create');
Route::post('/','TaskController@store')->name('store');
Route::get('/show/{id}', 'TaskController@show')->name('show');
Route::get('/show/{id}/edit', 'TaskController@edit')->name('edit');
Route::patch('/show/{id}', 'TaskController@update')->name('update');

Auth::routes();
