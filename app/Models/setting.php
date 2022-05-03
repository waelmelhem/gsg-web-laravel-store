<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    const CACHE_KEY='app_settings';
    protected $primarykey='name';
    protected $fillable=['name',"value","group"];
    public $incrementing=false;
    
    use HasFactory;
}
