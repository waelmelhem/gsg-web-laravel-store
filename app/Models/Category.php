<?php

namespace App\Models;

use App\Models\Scopes\Scope1;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name' ,'slug','description','parent_id','image'];
    
    protected static function booted(){
        // static::addGlobalScope(new Scope1());
        // static::addGlobalScope('main-Category',function (Builder $builder){
        //     $builder->whereNull('categories.parent_id');
        // });
    }
    protected static function scopeSearch(Builder $builder,$value){
        // dd($value);
        $builder->where('categories.name','like',"%$value%");
    }
}
