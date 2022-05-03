<?php
namespace App\Helper;

use Illuminate\Support\Facades\Config;
use NumberFormatter;
class Money
{
    static public function format($value){
        // dd(config('app.locale'));
        $formatter=new NumberFormatter('en',NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value,config('app.currency','ILS'));
    }
    
}