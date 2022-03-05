<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Str;
class OrderItem extends Model
{
    public $timestamps = false;
    use HasFactory;
    public $incrementing=false;
    public $keyType="string";
    protected $fillable=[
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity'
    ];
    protected static function booted(){
        static::creating(function(OrderItem $item){
            $item->id=Str::uuid();
        });
    }
    public function order(){
        $this->belongsTo(Order::class);

    }
    public function product(){
        $this->belongsTo(Product::class);
        
    }
}
