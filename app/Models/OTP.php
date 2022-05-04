<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $fillable=['code',"phone_number"];
    protected $primarykey="phone_number";
    protected $key='string';
    public $incrementing=false;

    public $timestamps=false;
}   
