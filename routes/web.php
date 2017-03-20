<?php

/*
* Web Routes
*/

/** Section Route */
Route::group(['prefix' => 'school/level/section'], function() {
    Route::post('/create',[
      'uses' => 'SectionController@secCreate',
      'as' => 'sec.create'
    ]);
    Route::post('/update',[
      'uses' => 'SectionController@secUpdate',
      'as' => 'sec.update'
    ]);
});
/** End Section Route */
/** Level Route */
Route::group(['prefix' => 'school/level'], function () {
  Route::get('/', [
    'uses' => 'LevelController@lvlIndex',
    'as' => 'lvl.index'
  ]);
  Route::post('/table',[
    'uses' => 'LevelController@lvlTable',
    'as' => 'lvl.table'
  ]);
  Route::get('/{year}', [
      'uses' => 'LevelController@getLvlTable',
      'as' => 'lvl.getTable'
  ]);
  Route::post('/create',[
    'uses' => 'LevelController@lvlCreate',
    'as' => 'lvl.create'
  ]);
  Route::post('/update',[
    'uses' => 'LevelController@lvlUpdate',
    'as' => 'lvl.update'
  ]);
});
/** End Level Route */

/** Employee Route */
Route::group(['prefix' => 'school/employee'], function () {
  Route::get('/', [
    'uses' => 'EmployeeController@empIndex',
    'as' => 'emp.index'
  ]);
  Route::post('/table',[
    'uses' => 'EmployeeController@empTable',
    'as' => 'emp.table'
  ]);
  Route::post('/create',[
    'uses' => 'EmployeeController@empCreate',
    'as' => 'emp.create'
  ]);
  Route::post('/update',[
    'uses' => 'EmployeeController@empUpdate',
    'as' => 'emp.update'
  ]);
});
/** End Employee Route */

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