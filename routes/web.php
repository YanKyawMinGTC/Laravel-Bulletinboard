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
Route::get('/user/create_user', function () {
    return view('user/create_user');
});
Route::get('/post/create_post', function () {
    return view('post/create_post');
});

Auth::routes();

Route::resource("posts", "Post\PostController");

Route::get('users/{$id}', 'User\UserController@change_password')->name('users.change_password');
Route::resource("users", "User\UserController");

Route::post('/search_post', "Post\SearchController@post_search");
Route::post('/search_user', "Post\SearchController@user_search");

Route::post('import', 'Post\FileController@import')->name('import');
Route::get('export', 'Post\FileController@export')->name('export');
