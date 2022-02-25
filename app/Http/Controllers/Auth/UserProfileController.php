<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
// use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index(){
        $user=Auth::user();
        // $user->profile=new Profile();
        return view('auth.user-profile',compact('user'));
    }

    public function update(Request $request,$id){
        $user=Auth::user();
        $request->validate([
            'name'=>"required|string|max:255",
            'first_name'=>"required|string|max:255",
            'last_name'=>"required|string|max:255",
            'date'=>'date|before:today',
            'gender'=>'required|in:female,male',
            "email"=>['required','string','unique:users,id,'.$user->id],
            'country_code'=>['required','string'],
            'locale'=>['required','string'],
            'timezone'=>['required','string'],

        ]);
        // dd($request);
        $request->merge(['user_id'=>$user->id]);
        // dd($request);
        User::where('id',$user->id)->update($request->only(['name',"email"]));
        if(!$user->profile->exists){
            Profile::create($request->all());
        }
        else{
            $user->profile->update($request->all());
        }
        return redirect()->route('profile')->with('success',"user info update");
    }
    
}
