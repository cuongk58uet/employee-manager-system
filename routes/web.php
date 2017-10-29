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

Route::redirect('/', '/login');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/reset/password', 'UserController@showResetForm')->name('password.reset.first');
Route::post('/reset/password', 'UserController@reset');
