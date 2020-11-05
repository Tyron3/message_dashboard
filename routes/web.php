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

Route::get('/', 'MessageController@index')->name('home');
Route::get('/title', 'MessageController@title')->name('title');
Route::get('/users', 'MessageController@users')->name('users');
Route::get('/rooms', 'MessageController@rooms')->name('rooms');
Route::get('/messageType', 'MessageController@messageType')->name('messageType');