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

Route::get('/', 'Switches\SwitchController@index')->name('index');
Route::get('/down', 'Switches\SwitchController@down')->name('down');
Route::get('/up', 'Switches\SwitchController@up')->name('up');
