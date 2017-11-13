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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Admin
Route::get('/user/{id}', 'UserController@index')->name('user.single');

Route::get('/clients', 'Admin\UserController@index')->name('admin.users.index');
Route::post('/clients', 'Admin\UserController@create')->name('admin.users.create');
Route::patch('/clients/{id}', 'Admin\UserController@edit')->name('admin.users.edit');
Route::delete('/clients/{id}', 'Admin\UserController@destroy')->name('admin.users.destroy');

Route::get('/todo-status', 'Admin\TodoStatusController@index')->name('admin.todo-status.index');
Route::post('/todo-status', 'Admin\TodoStatusController@create')->name('admin.todo-status.create');
Route::patch('/todo-status/{id}', 'Admin\TodoStatusController@edit')->name('admin.todo-status.edit');
Route::delete('/todo-status/{id}', 'Admin\TodoStatusController@destroy')->name('admin.todo-status.destroy');
