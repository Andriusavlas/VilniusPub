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

Route::get('/', 'PubsController@index')->name('home');

Auth::routes();

Route::get('/dashboard/{id}', 'DashboardController@index')->name('dashboard')->middleware('user_check');

Route::resource('pubs','PubsController');

Route::get('/pubs/vote/{id}', 'PubsController@vote')->name('vote')->middleware('has_voted')->middleware('auth');

Route::post('/comments/store/{id}', 'CommentsController@store')->name('add_comment');
Route::any('/comments/delete/{id}', 'CommentsController@destroy')->name('delete_comment')->middleware('comment_author_check');

Route::get('comments/edit/{id}', 'CommentsController@edit')->name('edit_comment')->middleware('comment_author_check');

Route::any('comments/update/{id}','CommentsController@update')->name('update_comment')->middleware('comment_author_check');