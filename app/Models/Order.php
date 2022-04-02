<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'number','status','payment_status',
        'payment_method','payment_transaction_id',
        'payment_data','ip',
        'user_agent','discount','tax','total'

    ];
    protected $casts=[
        "payment_data"=>"json"
    ];
    protected static function booted()
    {
        static::creating(function(Order $order){
            $now = Carbon::now();
            $number=Order::whereYear('created_at',$now->year)->max('number');
            if(!isset($number)){
                $number = $now->year."00001";
            }
            else{
                $number++;
            }
            $order->number=$number;
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function addresses(){
        return $this->hasMany(OrderAdress::class,'order_id');
    }
    public function items(){
        return $this->hasMany(OrderItem::class,'order_id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id'); 
    }
}
