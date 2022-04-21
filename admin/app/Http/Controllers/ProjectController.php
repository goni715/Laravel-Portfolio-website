<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsModel;

class ProjectController extends Controller
{
    
    function ProjectIndex(){


        return view('Projects');
        
    }



    function getProjectsData(){
     
        $result = json_encode(ProjectsModel::orderBy('id','desc')->get());                      
        return $result;       

     }




     /* Projects Data Insert function Started */
     function ProjectsDataInsert(Request $req){
 
        
      $project_name = $req->input('project_name');
      $project_des = $req->input('project_des');
      $project_link = $req->input('project_link');
      $project_img = $req->input('project_img');
  
    
      $result = ProjectsModel::insertOrIgnore([
              'project_name'=>$project_name,
              'project_des'=>$project_des,
              'project_link'=>$project_link,
              'project_img'=>$project_img
           ]);
    
    
             if($result == true){
    
                  return 1;
    
               }else{
    
                  return 0;
               }
   
    
    }/* Projects Data Insert function Ended */






    // ProjectsDelete function started
    function ProjectsDelete(Request $req){
 
      $id = $req->input('id');

       $result = ProjectsModel::where('id','=',$id)->delete();

     if($result == true){

           return 1;

        }else{

            return 0;
        }


   }/* Project Delete functin Ended */




     /* Project Edit form Data show function Started */
     function getProjectEditFormData(Request $req){
 
           $id = $req->input('id');

           $result = json_encode(ProjectsModel::where('id','=',$id)->get());

           return $result;


      }/* Project Edit form Data show function Ended */

 
     

      /* Project Update function Started */
      function ProjectUpdate(Request $req){
         
        $id = $req->input('id');
        $project_name = $req->input('project_name');
        $project_des = $req->input('project_des');
        $project_link = $req->input('project_link');
        $project_img = $req->input('project_img');


      $result = ProjectsModel::where('id','=',$id)->update([
                      'project_name'=>$project_name,
                      'project_des'=>$project_des,
                      'project_link'=>$project_link,
                      'project_img'=>$project_img
                    ]);
    


        if($result ==true){

            return 1;

         }else{

             return 0;
         }


     }/* Project Update function Ended */



     
               
     




}
