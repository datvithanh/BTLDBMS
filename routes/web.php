<?php

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/add-data', 'HomeController@addData');
Route::get('/room', 'HomeController@rooms')->name('room');
Route::get('/renting', 'HomeController@rentings')->name('renting');
Route::post('/api/get-room', 'HomeController@getRoom');