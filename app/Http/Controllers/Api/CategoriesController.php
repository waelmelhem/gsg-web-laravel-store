<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index',"show");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(3);
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user= Auth::guard('sanctum')->user();
        if(!$user->tokenCan("category.create")){
            abort(403);
        }

        $request->validate([
            // "name"=>"required|string|max:255|unique:categories,name,".$id,
            "name"=>[
                'required',
                'string',
                'max:255',
                "unique:categories,name"
            ],
            "Category_Parent"=>"nullable|int|exists:categories,id",
            "description"=>"nullable|string|min:5",
            "image"=>"nullable|image|mimes:png,jpg|max:500|dimensions:min_width=150,min_hegiht=150"
        ]);
        $path=null;
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
            $file=$request->file('image');
            // dd($file,$request->image);
            $path=$file->store('thumbnail',[
                'disk'=>'uploads'
            ]);
            // echo $path;
            // exit;
            }
            else{
                throw ValidationException::withMessages([
                    'image'=>'File corrupted!'
                ]);
            }
        }
        // echo $path;
        // exit;
        $category= Category::create([
            'name'=>$request->name,
            // 'slug'=>Str::slug($request->name),
            'image'=>$path,
            'parent_id'=>$request->Category_Parent,
            'description'=>$request->description,
            
        ]);
            return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with("products")->findOrFail($id);
        return $category;
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
        $request->validate([
            // "name"=>"required|string|max:255|unique:categories,name,".$id,
            "name"=>[
                'sometimes','required',
                'string',
                'max:255',
            ],
            "Category_Parent"=>"sometimes|nullable|int|exists:categories,id",
            "description"=>"nullable|string|min:5",
            "image"=>"nullable|image|mimes:png,jpg|max:500|dimensions:min_width=150,min_hegiht=150"
        ]);
        $path=null;
        $old=null;
        if($request->hasFile('image')){
            $file=$request->file('image');
            if($file->isvalid()){
                $path=$file->store('thumbnail',[
                    'disk'=>'uploads'
                ]);
                $old=category::where('id',$id)->first()->image;
            }
        }
        if($path==null){
            $path=category::where('id',$id)->first()->image;
        }
        // dd();
        $category=category::where("id",$id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),       
            'parent_id'=>$request->Category_Parent,
            'image'=>$path,
            'description'=>$request->description
        ]);
        if($old){
            (Storage::disk('uploads')->delete($old));
        }
        return Category::where("id",$id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return [
            "messages"=>__('Category Deleted'),
        ];
    }
}
