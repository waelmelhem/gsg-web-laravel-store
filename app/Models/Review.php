<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'reviewable_type','user_id',
        'reviewable_id',"rating",'review'
    ];
    public function reviewable()
    {
        return $this->morphTo("reviewable");
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            "name" =>__('Anonymous')
        ]);
    }
}
