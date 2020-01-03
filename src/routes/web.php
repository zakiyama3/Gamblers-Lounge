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
Route::get('main', 'MainController@main')->name('main');
Route::post('main', 'MainController@mainPost')->name('mainPost');
Route::post('main', 'MainController@mainPostEdit')->name('mainPostEdit');
Route::delete('main', 'MainController@mainPostDelete')->name('mainPostDelete');
Route::get('follow', 'FollowController@follow')->name('follow');
Route::get('profile', 'ProfileController@profile')->name('profile');
Route::post('profile', 'ProfileController@profileEdit')->name('profileEdit');
Route::post('user/{id}', ['as'=>'user.update', 'uses'=>'UserController@updateUserProfile']);
Auth::routes();
