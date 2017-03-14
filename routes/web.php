<?php

/*
* Web Routes
*/

/** Schoo Year Route **/
Route::group(['prefix' => 'school/year'], function() {
  Route::get('/', [
    'uses' => 'SchoolYearController@syIndex',
    'as' => 'sy.index',
  ]);
  Route::post('/table',[
    'uses' => 'SchoolYearController@syTable',
    'as' => 'sy.table'
  ]);
  Route::post('/create',[
    'uses' => 'SchoolYearController@syCreate',
    'as' => 'sy.create'
  ]);
  Route::post('/update',[
    'uses' => 'SchoolYearController@syUpdate',
    'as' => 'sy.update'
  ]);
  Route::get('/{year}', [
    'uses' => 'SchoolYearController@syView',
    'as' => 'sy.view'
  ]);
});
/** End School Year Route **/

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