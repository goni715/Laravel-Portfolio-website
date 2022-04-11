<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;

class HomeController extends Controller
{
    
      function HomeIndex(){


        
             // Ip Get
             $UserIP=$_SERVER['REMOTE_ADDR'];
             date_default_timezone_set("Asia/Dhaka");
             $timeDate= date("Y-m-d h:i:sa");
  
            // Ip address & visiting_time Insert
  
             VisitorModel::insert(['ip_address'=>$UserIP, 'visit_time'=>$timeDate]);
  
             
             $ServicesData = json_decode( ServicesModel::all());

             $CoursesData = json_decode( CourseModel::orderBy('id','desc')->limit(6)->get());


  
            return view('Home',[
                 'ServicesData'=>$ServicesData,
                 'CoursesData'=>$CoursesData
            ]);



      }








}
