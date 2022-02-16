<?php
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;

class Scope1 implements Scope{
    public function apply(Builder $builder,Model $model){
        $builder->whereNull('categories.parent_id');
    }
}