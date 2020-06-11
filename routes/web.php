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

// ボード編集
Route::get('board/{board}/edit', 'BoardsController@edit')->name('boards.edit');
Route::put('board/{board}', 'BoardsController@update')->name('boards.update');

// ボード削除
Route::delete('board/{board}', 'BoardsController@destroy')->name('boards.delete');

// 選択したボードのタスク一覧
Route::get('board/{board}', 'BoardsController@show')->name('boards.show');

// タスク作成
Route::get('board/{board}/tasks/create', 'TasksController@create')->name('tasks.create');
Route::post('board/{board}/tasks', 'TasksController@store')->name('tasks.store');

// タスク編集
Route::get('board/{board}/tasks/{task}/edit', 'TasksController@edit')->name('tasks.edit');
Route::put('board/{board}/tasks/{task}', 'TasksController@update')->name('tasks.update');

// タスク削除
Route::delete('board/{board}/tasks/{task}', 'TasksController@destroy')->name('tasks.delete');
