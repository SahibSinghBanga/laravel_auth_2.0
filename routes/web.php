<?php

Route::get('/', 'TodosController@index');
Route::get('/about', 'PagesController@about')->name('pages.about');

/**
 * Login Route(s)
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Register Route(s)
 */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/**
 * Password Reset Route(S)
 */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

/**
 * Email Verification Route(s)
 */
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Todos Routes
Route::get('/todos','TodosController@index')->name('todos.index');
Route::get('/todos/create','TodosController@create')->name('todos.create');
Route::post('/todos','TodosController@store')->name('todos.store'); 
Route::get('/todos/{id}','TodosController@show')->name('todos.show');
Route::get('/todos/{id}/edit','TodosController@edit')->name('todos.edit');
Route::put('/todos/{id}','TodosController@update')->name('todos.update'); 
Route::delete('/todos/{id}','TodosController@destroy')->name('todos.destroy'); 

Route::get('/profile','ProfileController@index')->name('profile.index');
Route::put('/profile','ProfileController@update')->name('profile.update');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
