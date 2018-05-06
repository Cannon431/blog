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

Route::get('/', 'PostController@index');
Route::get('post/{id}', 'PostController@post')
    ->where('id', '\d+');
Route::get('category/{id}', 'PostController@category')
    ->where('id', '\d+');

Route::post('comment/add/{id}', 'CommentController@add')
    ->where('id', '\d+');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
