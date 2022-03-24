<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',"permissions"
    ];
    protected $casts=[
        'permissions'=>'array'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);

    }
    public function has($permission){
        // dd($permission);
        if(!$this->permissions){
            return false;
        }
        return in_array($permission,$this->permissions);
    }

}
