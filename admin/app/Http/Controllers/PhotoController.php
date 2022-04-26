<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModel;

class PhotoController extends Controller
{


    function PhotoIndex(){

          return view('Photo');
    }



      function PhotoUploads(Request $request){

           $result = $request->file('Filekey')->store('public');
         
           //$id = $request->input('id');

           if($result==true){
           return 1;

           }

           //return $photoPath;

          // return "Hello";

            //$photoName=(explode('/',$photoPath))[1];
    
            //$host=$_SERVER['HTTP_HOST'];
           // $location="http://".$host."/storage/".$photoName;
    
         // $result= PhotoModel::insert(['location'=>$location]);
        // $result= PhotoModel::insert(['location'=>$photoPath]);
        // return $result;

        // $result= PhotoModel::insert(['location'=>$photoPath]);
         //return $result;

       // $id = $request->input('id');

         //return $id;


        // $result = PhotoModel::where('id','=',1)->update(['location'=>$photoPath]);

        // return $result;

      }
}
