<?php
namespace App\Repositories\cart;

interface CartRepository{

    public function all();
    public function add($item,$qty=1);
    public function remove($id);
    public function empty();
    public function total();
    public function count();
    public function destroy(CartRepository $cart,$id);
}
