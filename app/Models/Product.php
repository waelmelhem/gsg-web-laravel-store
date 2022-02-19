<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','slug','category_id','description','image','price','compare_price','cost','SKU','barcode','quantity','status','availability'];

    public static function availabilityElement(){
        return ['in-stock','out-of-stock','back-order'];
    }
    public static function statusElement(){
        return ['active','draft','archived'];
    }
    protected static function scopeSearch(Builder $builder,$value){
        // dd($value);
        $builder->where('products.name','like',"%$value%");
    }
    protected static function booted(){
        static::softDeleted(function($category){
            if($category->image){
                (Storage::disk('uploads')->delete($category->image));
            }
        });
        static::creating(function($product){
            $product->slug=Str::slug($product->name);
        });
    }
}
