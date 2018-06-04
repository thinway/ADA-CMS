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

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');

Route::post('/posts/{post}/comments', 'CommentsController@store');

// Rutas de administración
Route::get('/admin', 'AdminController@index')->middleware('auth')->name('admin.panel');
Route::get('/admin/posts', 'PostsController@adminIndex')->middleware('auth')->name('admin.posts');
Route::get('/admin/posts/create', 'PostsController@create')->middleware('auth');
Route::post('/admin/posts', 'PostsController@store')->middleware('auth');
Route::get('/admin/posts/{post}/edit', 'PostsController@edit')->middleware('auth')->name('posts.edit');
Route::patch('/admin/posts/{post}', 'PostsController@patch')->name('posts.patch');

Auth::routes();