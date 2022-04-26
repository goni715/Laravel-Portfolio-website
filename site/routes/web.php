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

Route::post('/contactSend','App\Http\Controllers\HomeController@ContactSend');



Route::get('/courses','App\Http\Controllers\CoursesController@CoursePage');

Route::get('/projects','App\Http\Controllers\ProjectsController@ProjectPage');

Route::get('/policy','App\Http\Controllers\PolicyController@PolicyPage');

Route::get('/terms','App\Http\Controllers\TermsController@TermsPage');

Route::get('/contact','App\Http\Controllers\ContactController@ContactPage');