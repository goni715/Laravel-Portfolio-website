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
   

Route::get('/service','App\Http\Controllers\ServiceController@ServiceIndex');


Route::get('/getServicesData','App\Http\Controllers\ServiceController@getServiceData');


