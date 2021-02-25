<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register'=>false]);

// Route::get('/user-registation',[
// 	'uses'=>'UserRegistationController@ShowRegistationform',
// 	'as'=>'user-registation'
// ])->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
        
Route::get('/', 'HomeController@index')->name('home');

//User Section
// Route::get('/user-registation','UserRegistationController@ShowRegistationform')->name('user-registation');
// Route::post('/user-registation','UserRegistationController@UserSave')->name('user-save');
// Route::get('/user-list','UserRegistationController@ShowallUser')->name('user-list');
Route::get('/user-profile/{id}','UserRegistationController@userProfile')->name('user-profile');
Route::get('/user-change-info/{id}','UserRegistationController@ChageUserInfo')->name('Change-user-info');
Route::post('/update-user-info','UserRegistationController@UserInfoUpdate')->name('user-info-update');
Route::get('/user-profile-change/{id}','UserRegistationController@UserprofileChange')->name('Change-user-profile');
Route::post('/user-photo-update','UserRegistationController@UpdateUserPhoto')->name('update-user-photo');
Route::get('/user-password-change/{id}','UserRegistationController@ChangeUserPassword')->name('Change-user-password');
Route::post('/user-password-update','UserRegistationController@UserPasswordUpdate')->name('update-user-password');
Route::resource('users', 'Users\UserRegistationController');

// Header Footer Section
Route::resource('header_footers', 'Header_footer\HeaderFooterController');

//Slider Section
Route::get('slider/unpublish/{id}','Slider\SliderController@slideUnpublish')->name('sliders.unpublish');
Route::get('slider/publish/{id}','Slider\SliderController@slidePublish')->name('sliders.publish');
Route::get('photo/gallery','Slider\SliderController@photoGallery')->name('all.slider.photo');
Route::resource('sliders', 'Slider\SliderController');

//School Management Start
Route::get('schools/unpublish/{id}','School\SchoolController@schoolUnpublish')->name('schools.unpublish');
Route::get('schools/publish/{id}','School\SchoolController@schoolPublish')->name('schools.publish');
Route::resource('schools', 'School\SchoolController');

//Class Management
Route::get('/class/unpublish/{id}','ClassManage\ClassManageController@unPublish')->name('classes.unpublish');
Route::get('/class/publish/{id}','ClassManage\ClassManageController@publish')->name('classes.publish');
Route::resource('classes', 'ClassManage\ClassManageController');

//Batch Management

Route::get('/class/wise/student/type','Batch\BatchManagementController@classwiseStudentType')->name('class-wise-student-type');
Route::get('batch/list-by/ajax','Batch\BatchManagementController@batchListByAjax')->name('batch-list-by-ajax');
Route::get('batch/unpublished-by/ajax','Batch\BatchManagementController@batchUnpublished')->name('batch-unpublished');
Route::get('batch/published-by/ajax','Batch\BatchManagementController@batchPublished')->name('batch-published');
Route::get('batch/delete-by/ajax','Batch\BatchManagementController@batchDelete')->name('delete-batch');
Route::get('batch/edit/ajax/{id}','Batch\BatchManagementController@batchEdit')->name('batch-edit');
Route::post('batch/update','Batch\BatchManagementController@batchUpdate')->name('batch-update');
Route::resource('batches', 'Batch\BatchManagementController');

//StudentType Management Start//
Route::get('/studenttype/unpublish','Student\StudentTypeController@studentTypeUnpublish')->name('studenttypes.unpublish');
Route::get('/studenttype/publish','Student\StudentTypeController@studentTypePublish')->name('studenttypes.publish');
Route::post('/studenttype/update','Student\StudentTypeController@studentTypeUpdate')->name('studenttype.update');
Route::get('/studenttype/delete','Student\StudentTypeController@studentTypeDelete')->name('studenttypes.delete');
Route::resource('studenttypes', 'Student\StudentTypeController');

//Student Management Start//
Route::get('/student/registation/form','StudentController@index')->name('student-registation');
Route::get('/bring-student-type','StudentController@bringStudentType')->name('bring-student-type');
Route::get('/batch-roll-form','StudentController@batchRollForm')->name('batch-roll-form');
Route::post('/student/registation','StudentController@studentSave')->name('student-save');
Route::get('/running/student/list','StudentController@allRunningStudentList')->name('all-running-student-list');
Route::get('/class/wise/student/list','StudentController@classSelectionForm')->name('class-selection-form');
Route::get('/class/wise/student/type','StudentController@classWiseStudentType')->name('class-wise-student-type');
Route::get('/classandtype/wise/student','StudentController@classAndTypeWiseStudent')->name('class-and-type-wise-student');
Route::get('/student/details/{id}','StudentController@studentDetails')->name('student-details');
Route::post('/student/basic/update','StudentController@BasicInfoUpdate')->name('basic-info-update');
//Batch Wise Student Section
Route::get('/student/batch-selection-form','StudentController@batchSelectionForm')->name('batch-selection-form');
Route::get('/class-and-type-wise-batch-list','StudentController@classAndTypeWiseBatchList')->name('class-and-type-wise-batch-list');
Route::get('/batch-wise-student-list','StudentController@batchWiseStudentList')->name('batch-wise-student-list');

        //Student Attendance Section Start//
    Route::prefix('attendance')->group(function(){
        Route::get('/add-attendance','StudentAttendanceController@batchSelectionFormForAttendanceAdd')->name('add-attendance');
        Route::get('/batch-wise-student-list-for-attendance','StudentAttendanceController@batchWiseStudentListForAttendance')->name('batch-wise-student-list-for-attendance');
        Route::post('/add-attendance','StudentAttendanceController@saveStudentAttendance')->name('save-student-attendance');
    });

            //Date Management Section Start//
    Route::prefix('Date')->group(function(){
        Route::get('/add-year','DateManagementController@addYear')->name('add-year');
    });

});