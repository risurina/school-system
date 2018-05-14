<?php

/*
* Web Routes
*/

/** Logs **/
Route::get('logs/{rfcard_id}/{accessPoint}',[
  'uses' => 'LogController@create',
  'as' => 'logs'
]);

Route::get('logs/fingerprint/{type}/{id}/{accessPoint}',[
  'uses' => 'LogController@fingerprintLogcreate',
  'as' => 'logs.fingerprint'
]);

/** End Logs */

/** Settings Routes */
Route::group(['prefix' => 'school/setting'], function() {
    Route::get('/', [
      'uses' => 'SettingController@settingIndex',
      'as' => 'setting.index',
    ]);
});
/** End Settings Route */

/** Attendance Routes */
Route::group(['prefix' => 'school/attendance'], function() {
    Route::get('/', [
      'uses' => 'AttendanceController@attendanceIndex',
      'as' => 'attendance.index',
    ]);

    Route::post('/table',[
    'uses' => 'AttendanceController@attendanceTable',
    'as' => 'attendance.table'
  ]);
});
/** End Attendance Route */

/** Student Payment Route */
Route::group(['prefix' => 'school/student/payment'], function() {
    Route::post('/create',[
      'uses' => 'StudentPaymentController@paymentCreate',
      'as' => 'studentPayment.create'
    ]);

    Route::post('/update',[
      'uses' => 'StudentPaymentController@paymentUpdate',
      'as' => 'studentPayment.update'
    ]);

    Route::post('/cancel',[
      'uses' => 'StudentPaymentController@paymentCancel',
      'as' => 'studentPayment.cancel'
    ]);

    Route::post('/restore',[
      'uses' => 'StudentPaymentController@paymentRestore',
      'as' => 'studentPayment.restore'
    ]);
});
/** End Student Payment Route */

/** Student Fee Route */
Route::group(['prefix' => 'school/student/fee'], function() {
    Route::post('/list', [
      'uses' => 'StudentFeeController@feeList',
      'as' => 'studentFee.list'
    ]);

    Route::post('/create',[
      'uses' => 'StudentFeeController@feeCreate',
      'as' => 'studentFee.create'
    ]);

    Route::post('/update',[
      'uses' => 'StudentFeeController@feeUpdate',
      'as' => 'studentFee.update'
    ]);

    Route::post('/delete',[
      'uses' => 'StudentFeeController@feeDelete',
      'as' => 'studentFee.delete'
    ]);
});
/** End Student Fee Route */

/** Student Progress Route */
Route::group(['prefix' => 'school/student/progress'], function() {
    Route::post('/enroll', [
      'uses' => 'StudentProgressController@studentProgressEnroll',
      'as' => 'studentProgress.enroll'
    ]);

    Route::post('/update', [
      'uses' => 'StudentProgressController@studentProgressUpdate',
      'as' => 'studentProgress.update'
    ]);

    Route::post('/print', [
      'uses' => 'StudentProgressController@studentProgressPrint',
      'as' => 'studentProgress.print'
    ]);

    Route::post('/print/soa/{type?}', [
      'uses' => 'StudentProgressController@studentProgressPrintSOA',
      'as' => 'studentProgress.printSOA'
    ]);

    # delete upon production
    Route::get('/print/id/{studentProgress?}', [
      'uses' => 'StudentProgressController@studentProgressPrintID',
      'as' => 'studentProgress.printID'
    ]);

    Route::post('/upload/image', [
      'uses' => 'StudentProgressController@studentProgressUploadImage',
      'as' => 'studentProgress.uploadImage'
    ]);
});
/** End Student Progress Route */

/** Student Route */
Route::group(['prefix' => 'school/student'], function() {
    Route::get('/', [
      'uses' => 'StudentController@studentIndex',
      'as'  => 'student.index',
    ]);
    Route::post('/table',[
      'uses' => 'StudentController@studentTable',
      'as' => 'student.table'
    ]);
    Route::post('/create',[
      'uses' => 'StudentController@studentCreate',
      'as' => 'student.create'
    ]);
    Route::post('/update',[
      'uses' => 'StudentController@studentUpdate',
      'as' => 'student.update'
    ]);
    Route::post('/delete', [
      'uses' => 'StudentController@studentDelete',
      'as' => 'student.delete'
    ]);
    Route::post('/restore', [
      'uses' => 'StudentController@studentRestore',
      'as' => 'student.restore'
    ]);
    Route::get('/profile/{id}/{sy?}', [
      'uses' => 'StudentController@studentProfile',
      'as' => 'student.profile'
    ]);
});
/** End Student Route */

/** School Year Level Route */
Route::group(['prefix' => 'school/sy/level'], function() {
    Route::post('/list', [
      'uses' => 'SchoolYearLevelController@levelList',
      'as' => 'syLevel.list'
    ]);

    Route::post('/create', [
      'uses' => 'SchoolYearLevelController@levelCreate',
      'as' => 'syLevel.create'
    ]);

    Route::post('/delete', [
      'uses' => 'SchoolYearLevelController@levelDelete',
      'as' => 'syLevel.delete'
    ]);
});
/** End School Year Level Route */

/** School Year Level Fee Route */
Route::group(['prefix' => 'school/level/fee'], function() {
    Route::post('/list', [
      'uses' => 'SchoolYearLevelFeeController@feeList',
      'as' => 'sylvlfee.list'
    ]);

    Route::post('/create',[
      'uses' => 'SchoolYearLevelFeeController@feeCreate',
      'as' => 'sylvlfee.create'
    ]);

    Route::post('/update',[
      'uses' => 'SchoolYearLevelFeeController@feeUpdate',
      'as' => 'sylvlfee.update'
    ]);

    Route::post('/delete',[
      'uses' => 'SchoolYearLevelFeeController@feeDelete',
      'as' => 'sylvlfee.delete'
    ]);
});
/** End School Year Level Fee Route */

/** Section Route */
Route::group(['prefix' => 'school/level/section'], function() {
    Route::post('/list', [
      'uses' => 'SchoolYearLevelSectionController@sectionList',
      'as' => 'section.list'
    ]);

    Route::post('/create',[
      'uses' => 'SchoolYearLevelSectionController@sectionCreate',
      'as' => 'section.create'
    ]);

    Route::post('/update',[
      'uses' => 'SchoolYearLevelSectionController@sectionUpdate',
      'as' => 'section.update'
    ]);

    Route::post('/delete',[
      'uses' => 'SchoolYearLevelSectionController@sectionDelete',
      'as' => 'section.delete'
    ]);
});
/** End Section Route */

/** Schedule Route */
Route::group(['prefix' => 'school/schedule'], function () {
  Route::post('/table',[
    'uses' => 'ScheduleController@scheduleTable',
    'as' => 'schedule.table'
  ]);
  Route::post('/create',[
    'uses' => 'ScheduleController@scheduleCreate',
    'as' => 'schedule.create'
  ]);
  Route::post('/update',[
    'uses' => 'ScheduleController@scheduleUpdate',
    'as' => 'schedule.update'
  ]);
});
/** End Schedule Route */

/** Fee Route */
Route::group(['prefix' => 'school/fee'], function () {
  Route::post('/table',[
    'uses' => 'FeeController@feeTable',
    'as' => 'fee.table'
  ]);
  Route::post('/create',[
    'uses' => 'FeeController@feeCreate',
    'as' => 'fee.create'
  ]);
  Route::post('/update',[
    'uses' => 'FeeController@feeUpdate',
    'as' => 'fee.update'
  ]);
});
/** End Fee Route */

/** Level Route */
Route::group(['prefix' => 'school/level'], function () {
  Route::post('/table',[
    'uses' => 'LevelController@lvlTable',
    'as' => 'lvl.table'
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
    'uses' => 'SchoolYearController@syProfile',
    'as' => 'sy.profile'
  ]);
  // student list
  Route::post('/{year}/student/table',[
    'uses' => 'SchoolYearController@syStudentTable',
    'as' => 'sy.studentTable'
  ]);

  Route::post('/masterlist',[
    'uses' => 'SchoolYearController@syMasterList',
    'as' => 'sy.masterlist'
  ]);
});
/** End School Year Route **/

/** School Route **/
Route::group(['prefix' => 'school'], function() {
  Route::get('/', [
    'uses' => 'SchoolController@schoolIndex',
    'as' => 'school.index'
  ]);
  Route::post('/', [
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
});

/** Admin Route **/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [
      'uses' => 'HomeController@admin',
      'as' => 'admin.index'
    ]);
});

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'index'
]);
/** End Admin Route */

/** Student Portal */
Route::group(['prefix' => '/portal/student'], function () {
  Route::get('/{sy?}', [
    'uses' => 'StudentPortalController@index',
    'as' => 'studentPortal.index'
  ]);
});
/** End Student Portal */

/** Login Auth for Employee and Student **/
Route::group(['prefix' => 'login'], function() {
    Route::get('/employee',[
      'uses' => 'Auth\EmployeeLoginController@showLoginForm',
      'as' => 'login.employee'
    ]);

    Route::post('/employee',[
      'uses' => 'Auth\EmployeeLoginController@login',
      'as' => 'login.employee'
    ]);

    Route::get('/student',[
      'uses' => 'Auth\StudentLoginController@showLoginForm',
      'as' => 'login.student'
    ]);

    Route::post('/student',[
      'uses' => 'Auth\StudentLoginController@login',
      'as' => 'login.student'
    ]);
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');