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
Route::prefix('/departments')->group(function(){
    Route::get('', 'DepartmentController@index')->name('departments');
    Route::get('/create', 'DepartmentController@create')->name('department.create');
    Route::post('/create', 'DepartmentController@store');
    Route::get('show/{id}', 'DepartmentController@show')->name('department.show');
    Route::get('edit/{id}', 'DepartmentController@edit')->name('department.edit');
    Route::post('/update', 'DepartmentController@update')->name('department.update');
    Route::post('/delete', 'DepartmentController@destroy')->name('department.delete');
});
