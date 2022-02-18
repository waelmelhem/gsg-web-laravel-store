<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','slug','category_id','description','image','price','compare_price','cost','SKU','barcode','quantity','status','availability'];

    public static function availabilityElement(){
        return ['in-stock','out-of-stock','bach-order'];
    }
    public static function statusElement(){
        return ['active','draft','archived'];
    }
}
