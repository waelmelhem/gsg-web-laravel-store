<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Profile(){
        return $this->hasOne(Profile::class,'user_id','id')->withDefault();
    }
    public function cartProducts(){
        return $this->belongsToMany(Product::class,
        'carts',
        'user_id',
        'product_id',
        'id',
        'id'
    );
    }
    public function cart(){
        return $this->hasMany(Cart::class,
        'user_id',
        'id'
    );
    }
    public  function reviews(){
        return $this->morphMany(Review::class,"reviewable");
    }
    public function  written_reviews()
    {
        return $this->hasMany(Review::class);
    }
}
