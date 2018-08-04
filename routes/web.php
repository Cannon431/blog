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

Route::group(['middleware' => ['blog']], function () {
    Route::get('/', 'PostController@index');
    Route::get('post/{id}', 'PostController@post')
        ->where('id', '\d+');
    Route::get('category/{id}', 'PostController@category')
        ->where('id', '\d+');

    Route::get('comment/add/{id}', 'CommentController@add')
        ->where('id', '\d+');

    Route::get('timezone/set', 'TimezoneController@set');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin', function () {
        return view('admin.dashboard');
    });
    Route::resource('admin/comments', 'Admin\\CommentsController');
    Route::resource('admin/posts', 'Admin\\PostsController');
    Route::resource('admin/categories', 'Admin\\CategoriesController');
    Route::resource('admin/authors', 'Admin\\AuthorsController');
    Route::resource('admin/users', 'Admin\\UsersController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
