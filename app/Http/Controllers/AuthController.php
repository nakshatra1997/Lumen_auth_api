<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {

    }
    public function register(Request $request)
    {
        $user=User::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>app('hash')->make($request->password),
            'api_token'=>str_random(50),
        ]);
        return response()->json(['data'=>$user],200);
    }
    public function login(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        if(!$user)
        {
            return response()->json(['status'=>'error','message'=>'user not found'],401);
        }
        if(Hash::check($request->password,$user->password))
        {
            $user->update(['api_token'=>str_random(50)]);
            return response()->json(['status'=>'success','data'=>$user],200);
        }
        return response()->json(['status'=>'error','message'=>'user not found'],401);

    }
    public function logout(Request $request)
    {
        $api_token=$request->api_token;
        $user=User::where('api_token',$api_token)->first();
        if(!$user)
        {
            return response()->json(['status'=>'error','message'=>'error in logging out'],401);
        }
        $user->api_token=null;
        $user->save();
        return response()->json(['status'=>'success','message'=>'successfully logged out']);
    }

}