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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'PostController@post');

Route::get('/profile', 'ProfileController@profile');

Route::get('/category', 'CategoryController@category');

Route::post('/addCategory', 'CategoryController@addCategory')->middleware('auth');

Route::post('/addProfile', 'ProfileController@addProfile')->middleware('auth');

Route::post('/addPost', 'PostController@addPost')->middleware('auth');

Route::get('/view/{id}', 'PostController@view');

Route::get('/like/{id}', 'PostController@like')->middleware('auth');

Route::post('/comment/{id}', 'PostController@comment')->middleware('auth');
