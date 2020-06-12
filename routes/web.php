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

Route::get('/', 'BoardsController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ボード作成
Route::get('board/create', 'BoardsController@create')->name('boards.create');
Route::post('board/store', 'BoardsController@store')->name('boards.store');


Route::group(['prefix'=>'board/{board}'], function(){
    // ボード編集
    Route::get('edit', 'BoardsController@edit')->name('boards.edit');
    Route::put('/', 'BoardsController@update')->name('boards.update');
    
    // ボード削除
    Route::delete('/', 'BoardsController@destroy')->name('boards.delete');
    
    // 選択したボードのタスク一覧
    Route::get('/', 'BoardsController@show')->name('boards.show');
    
    // タスク作成
    Route::get('create', 'TasksController@create')->name('tasks.create');
    Route::post('tasks', 'TasksController@store')->name('tasks.store');
    
    // タスク編集
    Route::get('tasks/{task}/edit', 'TasksController@edit')->name('tasks.edit');
    Route::put('tasks/{task}', 'TasksController@update')->name('tasks.update');
    
    // タスク削除
    Route::delete('tasks/{task}', 'TasksController@destroy')->name('tasks.delete');
   
    // ボードシェア 
    Route::post('share', 'BoardShareController@store')->name('board.share');
});

