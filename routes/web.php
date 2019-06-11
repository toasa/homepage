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

Route::prefix('/blog')->group(function() {
    // ブログトップページ（記事一覧を表示）へ
    Route::get('', 'BlogController@list')->name('list');

    // 投稿、編集、削除の操作にはBasic認証を設定する
    Route::group(['middleware' => 'auth.very_basic', 'prefix' => ''], function() {
        // ブログ新規投稿、または各ブログ編集画面へ
        Route::get('form/{id?}', 'BlogController@form')->name('form');
        // ブログ投稿
        Route::post('post', 'BlogController@post')->name('post');
        // ブログ削除
        Route::post('delete', 'BlogController@delete')->name('delete');
    });
});

// 書いたコードの一覧ページへ
Route::get('/codes', function () {
    return view('codes');
});