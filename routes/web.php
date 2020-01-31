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
Route::get('/user/createUser', function () {
    return view('user/createUser');
});
Route::get('/post/createPost', function () {
    return view('post/createPost');
});
Route::get('/post/uploadCsv', function () {
    return view('post/uploadCsv');
});
// login ,logout, register off
Auth::routes(['register' => false, 'verify' => false]);

Route::post("posts/confirm_update", "Post\PostController@confirm_update")->name('posts.confirm_update');
Route::post("posts/confirm_create", "Post\PostController@confirm_create")->name('posts.confirm_create');
Route::post("posts/import", "Post\PostController@import")->name('posts.import');
Route::get("posts/export", "Post\PostController@export")->name('posts.export');
Route::post("posts/search", "Post\PostController@search");
Route::resource("posts", "Post\PostController");

Route::post("users/confirm_update", "User\UserController@confirm_update")->name('users.confirm_update');
Route::post("users/confirm_create", "User\UserController@confirm_create")->name('users.confirm_create');

Route::post("users/search", "User\UserController@search");
Route::resource("users", "User\UserController");

Route::get('/changePwd/{id}', 'User\UserController@showchangePass')->name('users.showchangePass');
Route::post('/changePwd/{id}', 'User\UserController@changePass')->name('users.changePass');

Route::get('/import', 'Post\ImportController@getImport')->name('import');
Route::post('/import_parse', 'Post\ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'Post\ImportController@processImport')->name('import_process');
