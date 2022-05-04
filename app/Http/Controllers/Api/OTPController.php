<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\sendOTPMessage;
use App\Models\OTP;
use App\Notifications\sendOTPNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;

class OTPController extends Controller
{
    public function store(Request $request)
    {
        // dd('ss');
        $request->validate([
            'phone_number'=>'required',
        ]);

        $code=rand(100000,999999);
        $phone=$request->phone_number;
        OTP::updateOrCreate([
            'phone_number'=>$phone,
            'code'=>Hash::make($code),
            'created_at'=>Carbon::now()
        ]);
        dispatch(new sendOTPMessage($phone,$code));
        return [
            'message'=>__('OTP send')
        ];
    }
    public function verify(Request $request)
    {
        $request->validate([
            'phone_number'=>'required',
            'code'=>['required','int']
        ]);
        // dd($request->post('phone_number'));
        $otp =OTP::where('phone_number',$request->post('phone_number'))->orderBy('created_at', 'desc')->first();
        // dd($otp);
        if(!Hash::check($request->post('code'),$otp->code))
        {
            return Response::json([
                'message'=>__('invalid otp code')
            ],422);

        }
        $otp->delete();
        return Response::json([
            'message'=>__('code verified')
        ],200);
        
    }

}
