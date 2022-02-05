<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    
      function HomeIndex(){


        
             // Ip Get
             $UserIP=$_SERVER['REMOTE_ADDR'];
             date_default_timezone_set("Asia/Dhaka");
             $timeDate= date("Y-m-d h:i:sa");
  
            // Ip address & visiting_time Insert
  
             VisitorModel::insert(['ip_address'=>$UserIP, 'visit_time'=>$timeDate]);
  
  
             return view('Home');


      }



}
