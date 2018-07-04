<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('library','sectionController2');
 Route::get('library','sectionController2@index')->name('library.index');
 Route::post('library/store','sectionController2@store')->name('library.store');
 Route::patch('library/{id}/update','sectionController2@update')->name('library.update');
 Route::delete('library/{id}/destroy','sectionController2@destroy')->name('library.destroy');
 Route::post("library/{id}/restore",'sectionController2@restore')->name('library.restore');
 Route::post("library/{id}/deleteForever",'sectionController2@deleteForever')->name('library.delete-forever');
 Route::get('library/{id}/show','sectionController2@show')->name('library.show');
 Route::get('admin','sectionController2@admin')->name('admin');

 //Route::resource('books','bookController');
 Route::post('book/store','bookController@store')->name('book.store');
 Route::patch('book/{id}/update','bookController@update')->name('book.update');
 Route::delete('book/{id}/destroy','bookController@destroy')->name('book.destroy');
 Route::get('summary','bookController@summary')->name('summary');
 
  
 Route::get('/auth/login','Auth\AuthController@getLogin');
 Route::post('/auth/login','Auth\AuthController@postLogin')->name('login');
 Route::get('/auth/logout','Auth\AuthController@getLogout')->name('logout');

 Route::get('/auth/register','Auth\AuthController@getRegister');
 Route::post('/auth/register','Auth\AuthController@postRegister')->name('register');



 Route::get('/password/email','Auth\PasswordController@getEmail');
 Route::post('/password/email','Auth\PasswordController@postEmail')->name('password.email');

 Route::get('/password/reset/{token}','Auth\PasswordController@getReset');
 Route::post('/password/reset','Auth\PasswordController@postReset')->name('password.reset');

Route::post('store','sectionController2@store');
//get('/library',['middleware'=>'auth','uses'=>'sectionController2@index'])->name('library.index');