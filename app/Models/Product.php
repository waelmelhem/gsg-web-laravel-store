<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Product extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
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
    public function galleryUrls(){
        $urls=[];
        // dd($this->getMedia("gallery"));
        foreach ($this->getMedia("gallery") as $image){
            ($urls[$image->id]=str_replace("http://localhost","",$image->getUrl()));
        }
        return $urls;
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
    public  function reviews(){
        return $this->morphMany(Review::class,"reviewable");
    }
    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(100)
    //         ->height(100)
    //         ->sharpen(10);
    // }
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
