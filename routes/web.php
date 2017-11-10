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

Route::prefix('admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admins');
    Route::get('/create', 'AdminController@create')->name('admin.create');
    Route::post('/create', 'AdminController@store');
    Route::get('/show/{id}', 'AdminController@show')->name('admin.show');
    Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
    Route::post('/update', 'AdminController@update')->name('admin.update');
    Route::post('/delete', 'AdminController@destroy')->name('admin.delete');
    Route::get('/reset/password', 'AdminController@showResetForm')->name('password.reset.first');
    Route::post('/reset/password', 'AdminController@reset');
    Route::get('/reset', 'AdminController@showResetList')->name('admin.reset');
    Route::post('/reset', 'AdminController@resetPasswordOfListUser');
    Route::get('/search', 'AdminController@search');
});
Route::get('/mails', function() {
    return new App\Mail\ResetPasswordSuccess('cuongnm4215', 'manhcuong');
});

Route::prefix('user')->group(function(){
    Route::get('/profile', 'UserController@show')->name('user.profile');
    Route::get('/profile/edit', 'UserController@edit')->name('user.profile.edit');
    Route::post('/profile/edit', 'UserController@update');
    Route::get('/reset', 'UserController@showResetForm')->name('user.reset.password');
    Route::post('/reset', 'UserController@reset');
    Route::get('/department', 'UserController@myDepartment')->name('user.department');
    Route::get('/member/{id}', 'UserController@showMemberProfile')->name('user.member.profile');
    Route::get('download/csv', 'UserController@exportToCSV')->name('csv.export');
});
