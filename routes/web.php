<?php

/*
* Web Routes
*/

/** School Route **/
Route::group(['prefix' => 'school'], function() {
  Route::get('/', [
    'uses' => 'SchoolController@schoolIndex',
    'as' => 'school.index'
  ]);
  Route::post('/table',[
    'uses' => 'SchoolController@schoolTable',
    'as' => 'school.table'
  ]);
  Route::post('/create',[
    'uses' => 'SchoolController@schoolCreate',
    'as' => 'school.create'
  ]);
  Route::post('/update',[
    'uses' => 'SchoolController@schoolUpdate',
    'as' => 'school.update'
  ]);
  Route::post('/delete', [
    'uses' => 'SchoolController@schoolDelete',
    'as' => 'school.delete'
  ]);
  Route::post('/restore', [
    'uses' => 'SchoolController@schoolRestore',
    'as' => 'school.restore'
  ]);
  Route::get('/view/{id}', [
    'uses' => 'SchoolController@schoolView',
    'as' => 'school.view'
  ]);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');