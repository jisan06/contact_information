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

Route::get('/', 'ContactController@index')->name('contact_info.index');
Route::match(['GET', 'POST'], '/add', 'ContactController@add')->name('contact_info.add');
Route::match(['GET'], '/view/{id}', 'ContactController@view')->name('contact_info.view');
Route::match(['GET', 'POST'], '/edit/{id}', 'ContactController@edit')->name('contact_info.edit');
Route::post('//destroy', 'ContactController@destroy')->name('contact_info.destroy');