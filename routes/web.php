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

Route::prefix('/departments')->group(function(){
    Route::get('/', 'DepartmentController@index')->name('departments');
    Route::get('/create', 'DepartmentController@create')->name('department.create');
    Route::post('/create', 'DepartmentController@store');
    Route::get('/show/{id}', 'DepartmentController@show')->name('department.show');
    Route::get('/edit/{id}', 'DepartmentController@edit')->name('department.edit');
    Route::post('/update', 'DepartmentController@update')->name('department.update');
    Route::post('/delete', 'DepartmentController@destroy')->name('department.delete');
});

Route::prefix('users')->group(function(){
    Route::get('/', 'AdminController@index')->name('users');
    Route::get('/create', 'AdminController@create')->name('user.create');
    Route::post('/create', 'AdminController@store');
    Route::get('/show/{id}', 'AdminController@show')->name('user.show');
    Route::get('/edit/{id}', 'AdminController@edit')->name('user.edit');
    Route::post('/update', 'AdminController@update')->name('user.update');
    Route::post('/delete', 'AdminController@destroy')->name('user.delete');
    Route::get('/reset/password', 'AdminController@showResetForm')->name('password.reset.first');
    Route::post('/reset/password', 'AdminController@reset');
    Route::get('/reset', 'AdminController@showResetList')->name('user.reset');
    Route::post('/reset', 'AdminController@resetPasswordOfListUser');
});
Route::get('/mails', function() {
    return new App\Mail\ResetPasswordSuccess('cuongnm4215', 'manhcuong');
});
