<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $avg= $product->reviews()->avg("rating");
        return view('store.products.show',compact([
            'product',
            "category",
        ]));
    }
    public function review(Request $request,Product $product)
    {
        $request->validate([
            "rating"=>['required',"int",'in:1,2,3,4,5'],
            "review"=>["nullable","string"]
        ]);
        $product->reviews()->create([
            "user_id"=>Auth::id(),
            "rating"=>$request->rating,
            "review"=>$request->review,
        ]);
        $query= $product->reviews()
        ->selectRaw("AVG(rating) as rating")
        ->selectRaw("COUNT(*) as total")
        ->first();
        $product->forceFill([
            "rating"=>$query->rating,
            "total_reviews"=>$query->total
        ])
        ->save();
        return redirect()->to($product->url)->with("success",__('product reviewed'));
    }
}
