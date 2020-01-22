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
    return view('auth/login');
});
Auth::routes();

Route::resource("posts", "Post\PostController");
Route::resource("users", "User\UserController");
Route::any('/search', "Post\SearchController@index");

Route::post('import', 'Post\FileController@import')->name('import');
Route::get('export', 'Post\FileController@export')->name('export');
