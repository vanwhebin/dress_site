<?php
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/test', 'StaticPagesController@curl')->name('curl');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
// Route::get('/policy', 'StaticPagesController@policy')->name('policy');

Route::get('/signup', 'UsersController@create')->name('signup');
Route::get('/login', 'UsersController@login')->name('login');
Route::resource('users', 'UsersController');


// Route::get('login', 'SessionsController@create')->name('login');
// Route::post('login', 'SessionsController@store')->name('login');
// Route::delete('logout', 'SessionsController@destroy')->name('logout');

Auth::routes();

Route::view('mix/view', 'mix.view');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('validation')->group(function () {
    Route::get('create', 'ValidationController@create');
    Route::post('store', 'ValidationController@store');
    Route::get('edit', 'ValidationController@edit');
    Route::post('update', 'ValidationController@update');
});
