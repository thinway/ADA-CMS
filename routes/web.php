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

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostsController@index');

Route::get('/posts/create', 'PostsController@create')->middleware('auth');
Route::post('/posts', 'PostsController@store')->middleware('auth');
Route::get('/posts/{post}', 'PostsController@show');

Auth::routes();