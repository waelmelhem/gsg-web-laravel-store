<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey='user_id';
    protected $fillable = ['user_id','first_name','last_name','gender','brithday','address','city','country_code','locale','timezone'];

public function user(){
    
    return $this->belongsTo(User::class,'user_id','id');
}
}
