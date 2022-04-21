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

Route::get('/','App\Http\Controllers\HomeController@HomeIndex');

Route::get('/visitor','App\Http\Controllers\VisitorController@VisitorIndex');
   



// Admin Panel Service Management
Route::get('/service','App\Http\Controllers\ServiceController@ServiceIndex');
Route::get('/getServicesData','App\Http\Controllers\ServiceController@getServiceData');
Route::post('/ServiceDelete','App\Http\Controllers\ServiceController@ServiceDelete');
Route::post('/ServiceEditform','App\Http\Controllers\ServiceController@getServiceEditFormData');
Route::post('/ServiceUpdate','App\Http\Controllers\ServiceController@ServiceUpdate');
Route::post('/ServiceDataInsert','App\Http\Controllers\ServiceController@ServiceDataInsert');




// Admin Panel Courses Management
Route::get('/courses','App\Http\Controllers\CoursesController@CoursesIndex');
Route::get('/getCoursesData','App\Http\Controllers\CoursesController@getCoursesData');
Route::post('/CoursesDataInsert','App\Http\Controllers\CoursesController@CoursesDataInsert');
Route::post('/CoursesDelete','App\Http\Controllers\CoursesController@CoursesDelete');
Route::post('/CourseEditform','App\Http\Controllers\CoursesController@getCourseEditFormData');
Route::post('/CourseUpdate','App\Http\Controllers\CoursesController@CourseUpdate');



// Admin Panel Project Management
Route::get('/project','App\Http\Controllers\ProjectController@ProjectIndex');
Route::get('/getProjectsData','App\Http\Controllers\ProjectController@getProjectsData');
Route::post('/ProjectsDataInsert','App\Http\Controllers\ProjectController@ProjectsDataInsert');
Route::post('/ProjectsDelete','App\Http\Controllers\ProjectController@ProjectsDelete');
Route::post('/ProjectEditform','App\Http\Controllers\ProjectController@getProjectEditFormData');
Route::post('/ProjectUpdate','App\Http\Controllers\ProjectController@ProjectUpdate');