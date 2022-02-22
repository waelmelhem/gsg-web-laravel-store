<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangeUserPasswordController extends Controller
{
    public function __construct(){
        $this->middleware('verified');
    }
    public function index(){
        return view('auth.change-password');
    }
    public function update(Request $req){
        $user =$req->user();
        $req->validate([
            'password'=>['required','password'],
            'new_password'=>'required|min:8|confirmed:password'
        ]);
        $user->forceFill([
            'password'=>Hash::make($req->new_password),
            'remember_token'=>null
        ])->save();
        return redirect('profile')->with('success','password updated successfully');
    }
}
