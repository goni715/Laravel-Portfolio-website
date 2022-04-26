<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','App\Http\Controllers\HomeController@HomeIndex')->middleware('loginCheck');

Route::get('/visitor','App\Http\Controllers\VisitorController@VisitorIndex')->middleware('loginCheck');
   



// Admin Panel Service Management
Route::get('/service','App\Http\Controllers\ServiceController@ServiceIndex')->middleware('loginCheck');
Route::get('/getServicesData','App\Http\Controllers\ServiceController@getServiceData')->middleware('loginCheck');
Route::post('/ServiceDelete','App\Http\Controllers\ServiceController@ServiceDelete')->middleware('loginCheck');
Route::post('/ServiceEditform','App\Http\Controllers\ServiceController@getServiceEditFormData')->middleware('loginCheck');
Route::post('/ServiceUpdate','App\Http\Controllers\ServiceController@ServiceUpdate')->middleware('loginCheck');
Route::post('/ServiceDataInsert','App\Http\Controllers\ServiceController@ServiceDataInsert')->middleware('loginCheck');




// Admin Panel Courses Management
Route::get('/courses','App\Http\Controllers\CoursesController@CoursesIndex')->middleware('loginCheck');
Route::get('/getCoursesData','App\Http\Controllers\CoursesController@getCoursesData')->middleware('loginCheck');
Route::post('/CoursesDataInsert','App\Http\Controllers\CoursesController@CoursesDataInsert')->middleware('loginCheck');
Route::post('/CoursesDelete','App\Http\Controllers\CoursesController@CoursesDelete')->middleware('loginCheck');
Route::post('/CourseEditform','App\Http\Controllers\CoursesController@getCourseEditFormData')->middleware('loginCheck');
Route::post('/CourseUpdate','App\Http\Controllers\CoursesController@CourseUpdate')->middleware('loginCheck');



// Admin Panel Project Management
Route::get('/project','App\Http\Controllers\ProjectController@ProjectIndex')->middleware('loginCheck');
Route::get('/getProjectsData','App\Http\Controllers\ProjectController@getProjectsData')->middleware('loginCheck');
Route::post('/ProjectsDataInsert','App\Http\Controllers\ProjectController@ProjectsDataInsert')->middleware('loginCheck');
Route::post('/ProjectsDelete','App\Http\Controllers\ProjectController@ProjectsDelete')->middleware('loginCheck');
Route::post('/ProjectEditform','App\Http\Controllers\ProjectController@getProjectEditFormData')->middleware('loginCheck');
Route::post('/ProjectUpdate','App\Http\Controllers\ProjectController@ProjectUpdate')->middleware('loginCheck');



// Admin Panel Contact Management
Route::get('/contacts','App\Http\Controllers\ContactController@ContactIndex')->middleware('loginCheck');
Route::get('/getContactsData','App\Http\Controllers\ContactController@getContactsData')->middleware('loginCheck');
Route::post('/ContactDelete','App\Http\Controllers\ContactController@ContactsDelete')->middleware('loginCheck');




// Admin Panel Review Management
Route::get('/review','App\Http\Controllers\ReviewController@ReviewIndex')->middleware('loginCheck');
Route::get('/getReviewData','App\Http\Controllers\ReviewController@getReviewData')->middleware('loginCheck');
Route::post('/ReviewDataInsert','App\Http\Controllers\ReviewController@ReviewDataInsert')->middleware('loginCheck');
Route::post('/ReviewDelete','App\Http\Controllers\ReviewController@ReviewDelete')->middleware('loginCheck');
Route::post('/ReviewEditform','App\Http\Controllers\ReviewController@getReviewEditFormData')->middleware('loginCheck');
Route::post('/ReviewUpdate','App\Http\Controllers\ReviewController@ReviewUpdate')->middleware('loginCheck');







// Admin Panel Review Management
Route::get('/Login','App\Http\Controllers\LoginController@LoginIndex');
Route::post('/onLogin','App\Http\Controllers\LoginController@onLogin');
Route::get('/Logout','App\Http\Controllers\LoginController@onLogout');



//Admin Photo Gallery
Route::get('/photo','App\Http\Controllers\PhotoController@PhotoIndex');
Route::post('/PhotoUpload','App\Http\Controllers\PhotoController@PhotoUploads');