<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::delete('/deleteall', 'PostController@deleteAll');
Route::get('/crud', 'CrudController@create')->name('ajax');
Route::get('/post', 'PostController@index')->name('post');
Route::resource('posts', 'PostController');
Route::resource('cruds', 'CrudController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verification/{token}','Auth\RegisterController@verification');
