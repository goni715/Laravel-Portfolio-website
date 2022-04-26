<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;

class LoginController extends Controller
{
    
    function LoginIndex(){
    	return view('Login');
    }



   /*User Login System*/
    function onLogin(Request $request){

        $user_name = $request->input('user');
        $password = $request->input('pass');
         
        //ModelName::where('columnName','=',$value1)->where('columnName'=',$value2)->count();

       $countValue = AdminModel::where('username','=',$user_name)->where('password','=',$password)->count();

        if($countValue==true){

              $request->session()->put('userSession',$user_name);
              return 1;

        }else{

              return 0;

        }

    }





    /*user Logout system */
    function onLogout(Request $request){

        $request->session()->flush();
        return redirect('/Login');

    }
  




}
