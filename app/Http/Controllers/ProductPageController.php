<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index(Category $category=null)
    {
        if($category){
            $products= $category->products()->latest()->paginate(20);
            // dd($products);
            return view('store.products.index',compact([
                'category','products'
            ]));
        }
        $products=Product::with('category')->latest()->paginate(20);
        // dd($products);
        $category=new Category();
        return view('store.products.index',compact([
            'category','products'
        ]));
    }
    public function show(Category $category=null,Product $product=null){
        // dd($category);
        return view('store.products.show',compact([
            'product',
            "category"
        ]));
    }
}
