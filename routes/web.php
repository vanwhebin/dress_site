<?php
Route::get('/', 'PostController@index');
Route::get('/test', 'StaticPagesController@curl')->name('curl');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
// Route::get('/policy', 'StaticPagesController@policy')->name('policy');

Route::get('/login', 'UsersController@login')->name('login');

Route::view('mix/view', 'mix.view');
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('validation')->group(function () {
    Route::get('create', 'ValidationController@create');
    Route::post('store', 'ValidationController@store');
    Route::get('edit', 'ValidationController@edit');
    Route::post('update', 'ValidationController@update');
});


Auth::routes();
Route::resource('users', 'UsersController');
Route::resource('posts', 'PostController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
