<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Response;

use JWTAuth;
//use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTFactory;

class UserController extends Controller
{


   public function login(Request $request)
   {
     
    $email =  $request->email; 
    $password =  $request->password;
    $userData = $this->checkLogin($email,$password);
    if($userData )
    {
    $Payload = JWTFactory::sub($userData->id)
    ->username($userData->name)
    ->make();
    $response['token'] = JWTAuth::fromUser($userData,$Payload);
    $response['status'] = 1;
    $response['message'] = "User Login Successfully.";
    }
    else
    {
    $response['status'] = 0;
    $response['message'] = "Wrong Credencial.";
    }

    return Response::json($response);
   
   }


   public function checkLogin($email,$password) 
   {
    $data = User::where('email',$email)->get()->first();
    if(Hash::check($password, $data->password))
    {
      return $data;
    }
   }
    

    public function createUser(Request $request)
    {

      
       $name = $request->name;
       $email = $request->email;
       $password = Hash::Make($request->password);
       $checkEmailExits = $this->checkEmail($email);
       if($checkEmailExits == 0)
       {
       $user = new User();
       $user->name = $name;
       $user->email = $email;
       $user->password = $password;
       $user->save();
       $response['message'] = "User Create Successfully.";
       $response['data'] = $request->all();
       $response['status'] = 0;
       }
       else
       {
       $response['message'] = "Email ID Allready Exits.";
       $response['status'] = 1;
       }
       return Response::json($response);
    }

    public function checkEmail($email)
    {
      return $checkEmail = User::where('email',$email)->count();
    }
}
