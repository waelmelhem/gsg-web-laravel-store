<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product =new Product();
        $availability=product::availabilityElement();
        $status=product::statusElement();
        return view('dashboard.products.create',compact('product','availability','status'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules=$this->rules();
        $request->validate($rules);
        $path=null;
        if($request->hasFile('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $path=$image->store('thumbnail',[
                    'disk'=>'uploads'
                ]);
                // dd($path);
            }
        }
        $data=$request->except('image');
        $data['slug']=str::slug($request->name);
        $data['image']=$path;
        // dd($data);
        $product=product::create($data);
        return redirect()->route('dashboard.products.index')->with('success',"product ($product->name) created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=product::findOrFail($id);
        return view('dashboard.products.show',"product");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=product::findOrFail($id);
        $availability=product::availabilityElement();
        $status=product::statusElement();
        // dd($product);
        return view('dashboard.products.edit',compact("product",'availability','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=product::findOrFail($id);
        $rules=$this->rules($id);
        $request->validate($rules);
        $data=$request->except(['_token','_method','image']);
        $path=null;
        $old=null;
        if($request->hasFile('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $path=$image->store('thumbnail',[
                    'disk'=>'uploads'
                ]);
                $old=$product->image;
            }
        }
        $data['slug']=str::slug($request->name);
        $data['image']=$path;

        //can use tap function and use use to pass variable from global to closure fun
        $product=product::where("id",$id)->update($data);
        if(isset($old)){
            Storage::disk('uploads')->delete($old);
        }
        return redirect()->route('dashboard.products.index')->with('success',"product ($request->name) updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=product::withTrashed()->findOrFail($id);
        if($product->deleted_at){
            $product->forceDelete($id);
            Storage::disk('uploads')->delete( $product->image);
        }else{
            $product->delete($id);
        }
        return redirect()->route('dashboard.products.index')->with('success',"product ($product->name) deleted successfully");

    }
    public function trash()
    {
        $trashed =product::onlyTrashed()->get();
        return view('dashboard.products.trash',compact('trashed'));

    }
    public function restore($id){
        $product=product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.index')->with('success',"product ($product->name) restored successfully");

    }
    protected function rules($id=-1){
        if($id<=0)
        $id="";
        return [
            'name'=>"required|string|max:255",
            "category_id"=>"required|int|exists:categories,id",
            "image"=>"nullable|image",
            "price"=>"required|numeric|min:0",
            "cost"=>"numeric|min:0",
            'compare_price'=>"nullable|numeric|gt:price",
            'status'=>'in:active,draft,archived',
            "availability"=>'in:in-stock,out-of-stock,bach-order',
            'quantity'=>'nullable|int|min:0',
            "SKU"=>'nullable|string|unique:products,SKU,'.$id,
            "barcode"=>'nullable|string|unique:products,barcode,'.$id,
        ];
    }
}
