<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\API\V1\BaseController as BaseController;

use Laravel\Sanctum\PersonalAccessToken;
// use App\User;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{

    
    public function authenticate(Request $request)
    {
     $validateUser = Validator::make($request->all(),
     [
         'email' => 'required|email',
         'password' => 'required'
     ]);
 
     if($validateUser->fails()){
         return response()->json([
             'status' => false,
             'message' => 'validation error',
             'errors' => $validateUser->errors()
         ], 401);
     }
 
     $credentials = $request->only(['email', 'password']);
     if(!Auth::attempt($credentials)){
         return response()->json([
             'status' => false,
             'message' => 'Email & Password does not match with our record.',
         ], 401);
     }
 
     
     $user = User::where('email', $request->email)->first();
     if (empty($user)) {
         return response()->json([
             'status' => false,
             'message' => 'User does not exist',
         ], 401);
     } 
 
     return response()->json([
         'status' => true,
         'message' => 'User Logged In Successfully',
         'token' =>  $user->createToken("API TOKEN")->plainTextToken,
     ], 200);
 }



 public function registerAuth(Request $request)
    {
        // echo "123";
        // exit;
        $validatedData = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);


        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);


        return response()->json([
            'message'=>"User Created successfully"
        ], 201);
    }
};