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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/articles', 'ArticlesController@index');

Route::post('/articles/{post_name}/update/{id}', 'CommentController@update');
Route::get('/articles/{post_name}', 'ArticlesController@show');
Route::get('/articles/{post_name}/delete/{id}', 'CommentController@delete');
Route::post('/articles/{post_name}', 'CommentController@store');

Route::get('/admin', 'AdminController@index');
