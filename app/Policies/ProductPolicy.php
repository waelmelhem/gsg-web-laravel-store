<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;
    public function before(User $user,$ability)
    {
        dd($user->table);
        $admin=Admin::where($user->email,"");
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission("products.view");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, product $product)
    {
        return $user->hasPermission("products.view");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission("products.create");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, product $product)
    {
        return $user->hasPermission("products.update");

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, product $product)
    {
        return $user->hasPermission("products.delete");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, product $product)
    {
        return $user->hasPermission("products.delete");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  Illuminate\Foundation\Auth\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, product $product)
    {
        return $user->hasPermission("products.delete");
    }
}
