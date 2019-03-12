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
Route::get('/admin/articles', 'AdminController@articles');
Route::get('/admin/articles/{p}/', 'AdminController@articles');

Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/users/{p}/', 'AdminController@users');

Route::get('/admin/comments', 'AdminController@comments');
Route::get('/admin/comments/{p}/', 'AdminController@comments');

Route::get('/admin/{type}/grab/{id}', 'AdminController@display');
