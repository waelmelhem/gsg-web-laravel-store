<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderAdress extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id','type',
        'first_name','last_name',
        'phone_number','email',
        'street_address','city',
        'state','postal_code',
        'country_code'
    ];
    public function order(){
        $this->belongsTo(Order::class);
    }
}
