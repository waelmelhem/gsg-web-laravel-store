<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AcessTokensController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'email'=>"required|email",
            "password"=>'required',
            "deivce_name"=>'nullable',
            "scope"=>'sometimes|string'
        ]);
        $user =User::where('email','=',$request->email)
        ->first();
        if($user && Hash::check($request->password,$user->password)){
            $name=$request->post('device_name',$request->userAgent());
            if($request->has('scope')){
                $abilites=explode(",",$request->scope,);
            }
            else {
                $abilites=['*'];
            }
            $token=$user->createToken($name,$abilites);
            return response()->json([
                'token'=>$token->plainTextToken,
                'user'=>$user
            ],201);
        }
        return response()->json([
            "message" =>__("Invalid credentials!")
        ],401);
    }
    public function destroy()
    {
    $user=Auth::guard("sanctum")->user();
    $user->currentAccessToken()->delete();
    }
}

