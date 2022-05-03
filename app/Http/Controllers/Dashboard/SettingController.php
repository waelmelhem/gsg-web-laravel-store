<?php

namespace App\Http\Controllers\dashboard;

use App\Models\setting;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Locales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Intl\Currencies;

class SettingController extends Controller
{
    public function edit()
    {
        $settings=[
            'app_currency'=>'',
            "app_locale"=>'',
            'app_name'=>''
        ];
        if(Setting::all())
        {
            foreach(Setting::all() as $value)
        {
            $settings[implode('_',explode('.',$value['name']))] =$value['value'];
        }
        } 
        //can use :
        // dd(setting::pluck('name','value'));
        // dd($settings);
        return view('dashboard.settings',
    [
        'currencies'=>Currencies::getNames(),
        'locales'=>Locales::getNames(),"settings"=>$settings
    ]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'app_name'=>'required',
                'app_currency'=>'required',
                'app_locale'=>'required',
            ]
        );
        // ''=>$request->app_currency,
        //     ''=>$request->app_locale,
        $setting=$request->only("app_name",'app_locale','app_currency','app_ipStack');
        foreach($setting as $key=>$value)
        {
            $update1=setting::where('name',implode('.',explode('_',$key)))->update([
                'value'=>$value
            ]);
            if(!$update1)
            {
                setting::Create([
                        'name'=>implode('.',explode('_',$key)),
                        'value'=>$value
                    ]);
            }
        }
        event('setting.updated');
        return redirect("dashboard");
    }
}
