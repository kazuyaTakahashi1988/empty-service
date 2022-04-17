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

Route::get('/', 'PostController@index')->name('posts.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/posts', 'PostController',  ['except' => ['index']]);
Route::resource('/users', 'UserController');
Route::resource('/likes', 'LikeController');
Route::resource('/answers', 'AnswerController')->middleware('auth');
Route::post('/answers/create', 'AnswerController@create')->middleware('auth');
Route::resource('/comments', 'CommentController')->middleware('auth');

