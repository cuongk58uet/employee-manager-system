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
    Route::get('/', 'DepartmentController@index')->name('departments');
    Route::get('/create', 'DepartmentController@create')->name('department.create');
    Route::post('/create', 'DepartmentController@store');
    Route::get('/show/{id}', 'DepartmentController@show')->name('department.show');
    Route::get('/edit/{id}', 'DepartmentController@edit')->name('department.edit');
    Route::post('/update', 'DepartmentController@update')->name('department.update');
    Route::post('/delete', 'DepartmentController@destroy')->name('department.delete');
});

Route::prefix('users')->group(function(){
    Route::get('/', 'UserController@index')->name('users');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/create', 'UserController@store');
    Route::get('/show/{id}', 'UserController@show')->name('user.show');
    Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/update', 'UserController@update')->name('user.update');
    Route::post('/delete', 'UserController@destroy')->name('user.delete');
});
Route::get('/mails', function() {
    return new App\Mail\RegisterAccountSusscess('cuongnm4215', 'manhcuong');
});
