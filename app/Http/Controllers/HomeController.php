<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products=Product::latest()->limit(8)->get();
        $topSales=Product::inRandomOrder()->limit(10)->get();
        return (view('store.home',compact('products','topSales')));
    }
}
