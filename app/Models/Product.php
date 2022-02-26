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
    //one to many :many product belong to one category
    public function Category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function getImageUrlAttribute(){
        if(!$this->image){
            return  asset('/default/blank.jpg');
        }
        else if(Str::startsWith($this->image,['https','http'])){
            // dd($this->image);
            return $this->image;
        }
        else{
            return asset('/uploads/'.$this->image);
        }
    }
    public function getUrlAttribute(){
        return route('product.show',[$this->category->slug,$this->slug]);
    }
    public function getPercentAttribute(){
        return round((($this->compare_price-$this->price)/($this->compare_price))*100,2);
    }
    public function tags(){
        return $this->belongsToMany(Tags::class);
    //     return $this->belongsToMany(
    //         Tag::class,//Related model
    //         'product_tag',//pivote Table
    //         'product_id',//model FK in pivote
    //         'tag_id',//model FK in pivote
    //         'id',//local PK currrent
    //         'id'//locall PK related
    // );
    }
    public function cartUsers(){
        return $this->belongsToMany(User::class,
        'carts',
        'product_id',
        'user_id',
        'id',
        'id'
    );
    }
}
