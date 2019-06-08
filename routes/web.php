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

// トップページへ
Route::get('/', function () {
    return view('index');
});

// ブログトップページ（記事一覧を表示）へ
// name メソッドでエイリアスをつけることができる
Route::get('/blog', 'BlogController@list')->name('list');
// ブログ新規投稿、または各ブログ編集画面へ
Route::get('/blog/form/{id?}', 'BlogController@form')->name('form');
// ブログ投稿
Route::post('/blog/post', 'BlogController@post')->name('post');
// ブログ削除
Route::post('/blog/delete', 'BlogController@delete')->name('delete');

// 書いたコードの一覧ページへ
Route::get('/codes', function () {
    return view('codes');
});