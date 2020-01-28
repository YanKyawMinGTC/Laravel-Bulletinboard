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
Route::get('/user/change_password', function () {
    return view('user/change_password');
});
Route::get('/post/upload_csv', function () {
    return view('post/upload_csv');
});

Auth::routes();

Route::post("posts/confirm_update", "Post\PostController@confirm_update")->name('posts.confirm_update');
Route::post("posts/confirm_create", "Post\PostController@confirm_create")->name('posts.confirm_create');
Route::post("posts/import", "Post\PostController@import")->name('posts.import');
Route::get("posts/export", "Post\PostController@export")->name('posts.export');
Route::resource("posts", "Post\PostController");

Route::post("users/confirm_update", "User\UserController@confirm_update")->name('users.confirm_update');
Route::post("users/confirm_create", "User\UserController@confirm_create")->name('users.confirm_create');
Route::post("users/password", "User\UserController@change_pass")->name('users.password');
Route::resource("users", "User\UserController");

Route::post('/search_post', "Post\SearchController@post_search");
Route::post('/search_user', "Post\SearchController@user_search");
