<?php

namespace App\Models;

use App\Models\Scopes\Scope1;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name' ,'slug','description','parent_id','image'];
    protected $hidden=['updated_at','created_at','deleted_at',"image"];
    protected $appends=[
        'image_url'
    ];
    protected static function booted(){
        static::forceDeleted(function($category){
            if($category->image){
                (Storage::disk('uploads')->delete($category->image));
            }
        });
        static::creating(function($category){
            $category->slug=str::slug($category->name);
        });
    }
    protected static function scopeSearch(Builder $builder,$value){
        // dd($value);
        $builder->where('categories.name','like',"%$value%");
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
    //one to many 
    //many products can have one category
    public function products(){
        // return $this->hasMany(Product::class,'category_id','id');
        return $this->hasMany(Product::class);
    }
}
