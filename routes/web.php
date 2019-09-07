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

Route::middleware(['auth'])->group(function() {
	Route::get('tasks', 'TaskController@index');
	Route::post('tasks', 'TaskController@store')->name("tasks.create");
	Route::patch('tasks/{task}', 'TaskController@update')->name("tasks.update");
    // Route::resource('tasks', 'TaskController', [
    //     'only' => [
    //         'index', 'store', 'update'
    //     ]
    // ]);
});

Route::get('auth/facebook', 'Auth\FacebookloginController@redirectToFacebook')->name("fblogin");
Route::get('auth/facebook/callback', 'Auth\FacebookloginController@callback');

Route::middleware(['auth', 'admin'])->group(function() {
	Route::get('admin', 'AdminController@index');
    Route::delete('admin/user/{user}', 'AdminController@destroy')->name('user.delete');
});