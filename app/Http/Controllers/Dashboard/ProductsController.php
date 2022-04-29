<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductsController extends Controller
{
    // PUBLIC FUNCTION __CONSTRUCT(){
    //     // $this->middleware(['auth']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        // Gate::authorize('products.view');
        $this->authorize("viewAny",Product::class);
        $search=$req->query('search');
        $products=Product::search($search)->get();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gate::authorize('products.create');
        $this->authorize("create",Product::class);

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
        $this->authorize("create",Product::class);
        // Gate::authorize('products.create');
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
        
        // Gate::authorize('products.update');
        $product=product::findOrFail($id);
        $this->authorize("update",$product);
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
        // Gate::authorize('products.update');
        $product=product::findOrFail($id);
        $this->authorize("update",$product);
        $rules=$this->rules($id);
        $request->validate($rules);
        $data=$request->except(['_token','_method','image',"tags","gallery","delete_media"]);
        $path=$product->image;
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
        if($request->hasFile("gallery")){
            foreach($request->gallery as $image){
                $path_2=$image->store("product-gallery",[
                    'disk'=>"uploads"
                ]);
                $product->addMediaFromDisk($path_2,"uploads")
                ->toMediaCollection("gallery");
            }
        }
        $data['slug']=str::slug($request->name);
        $data['image']=$path;

        //can use tap function and use use to pass variable from global to closure fun
        $product=product::where("id",$id)->update($data);
        if(isset($old)){
            Storage::disk('uploads')->delete($old);
        }
        if($request->post("delete_media")){
            // dd("a");
            foreach($request->post("delete_media") as $key=>$id){
                Media::destroy($id);
            }
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
        // Gate::authorize('products.delete');
        $product=product::withTrashed()->findOrFail($id);
        $this->authorize("delete",$product);
        // dd($product->deleted_at);
        if($product->deleted_at!=null){
            $product->forceDelete($id);
            Storage::disk('uploads')->delete( $product->image);
        }else{
            $product->delete($id);
        }
        return redirect()->route('dashboard.products.index')->with('success',"product ($product->name) deleted successfully");

    }
    public function trash()
    {
        $this->authorize("delete",new Product());
        // Gate::authorize('products.delete');
        $trashed =product::onlyTrashed()->get();
        return view('dashboard.products.trash',compact('trashed'));

    }
    public function restore($id){
        // $this->authorize("delete",Product::class);
        // Gate::authorize('products.delete');
        $product=product::onlyTrashed()->findOrFail($id);
        $this->authorize("delete",$product);
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
            "cost"=>"nullable|numeric|min:0",
            'compare_price'=>"nullable|numeric|gt:price",
            'status'=>'in:active,draft,archived',
            "availability"=>'in:in-stock,out-of-stock,back-order',
            'quantity'=>'required|int|min:0',
            "SKU"=>'nullable|string|unique:products,SKU,'.$id,
            "barcode"=>'nullable|string|unique:products,barcode,'.$id,
            "delete_media"=>"nullable|array"
        ];
    }
}
