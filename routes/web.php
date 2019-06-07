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

Route::get('/', function () {
    return view('index');
});

Route::get('/blog', function () {
    return view('blog.blog');
});

// /blog/form に GET でアクセスすると、Postontroller の form メソッドを実行するという意味
// name メソッドでエイリアスをつけることができる
Route::get('/blog/form/{id?}', 'BlogController@form')->name('form');
Route::post('/blog/post', 'BlogController@post')->name('post');

Route::get('/codes', function () {
    return view('codes');
});