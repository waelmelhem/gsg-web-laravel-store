<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index(){
        $user=Auth::user();
        return view('auth.user-profile',compact('user'));
    }

    public function update(Request $request,$id){
        $user=Auth::user();
        $request->validate([
            'name'=>"required|string|max:255",
            "email"=>['required','string','unique:users,id,'.$user->id],
        ]);
        // dd($request);
        User::where('id',$id)->update($request->except(['_token',"_method"]));
        return redirect()->route('profile')->with('success',"user info update");
    }
    
}
