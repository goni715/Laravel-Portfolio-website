<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\ProjectsModel;
use App\Models\ContactModel;

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

             $ProjectData = json_decode( ProjectsModel::orderBy('id','desc')->limit(10)->get());


  
            return view('Home',[
                 'ServicesData'=>$ServicesData,
                 'CoursesData'=>$CoursesData,
                 'ProjectData'=>$ProjectData
            ]);



      }







      

/* Contact Data Send*/
     function ContactSend(Request $req){
 
      $contact_name = $req->input('contact_name');
      $contact_mobile = $req->input('contact_mobile');
      $contact_email = $req->input('contact_email');
      $contact_msg = $req->input('contact_msg');

      
  
    
      $result = ContactModel::insertOrIgnore([
              'contact_name'=>$contact_name,
              'contact_mobile'=>$contact_mobile,
              'contact_email'=>$contact_email,
              'contact_msg'=>$contact_msg
           ]);
    
    
             if($result == true){
    
                  return 1;
    
               }else{
    
                  return 0;
               }
     
    
    }/* Projects Data Insert function Ended */









}
