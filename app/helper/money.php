<?php
namespace App\Helper;
use NumberFormatter;
class Money
{
    static public function format($value){
        $formatter=new NumberFormatter('en',NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value,'ILS');
    }
}