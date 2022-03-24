<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Scopes\Scope1;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:categories.view")->only('index');
        $this->middleware("can:categories.update")->only(['update','edit']);
        $this->middleware("can:categories.delete")->only(['restore','destroy']);
        $this->middleware("can:categories.create")->only(["create"]);
    }
    protected function rules($id=0){
    return  $rules=[
        // "name"=>"required|string|max:255|unique:categories,name,".$id,
        "name"=>[
            'required',
            'string',
            'max:255',
            Rule::unique('categories','name')->ignore($id,'id'),
            // (new Unique('categories','name'))->ignore($id),
        ],
        "Category_Parent"=>"nullable|int|exists:categories,id",
        "description"=>"nullable|string|min:5",
        "image"=>"nullable|image|mimes:png,jpg|max:500|dimensions:min_width=150,min_hegiht=150"
    ];
}
    public function index(Request $req)
    {
        $search=$req->query('search');
        $categories = Category::
        // withoutGlobalScope(Scope1::class)->
        // // withoutGlobalScope('main-Category')
        // ->
        // withoutGlobalScopes()->//without soft delete and main-category
        leftJoin('categories as parents','parents.id',"categories.parent_id")
        ->select(['categories.*',
        'parents.name as parent_name'
        ])
        ->search($search)
        // ->whereNull('categories.parent_id')
        ->orderBy('categories.name')
        ->get();
        // dd($categories);
        return view('dashboard.categories.index',compact('categories'));
    }
    public function create()
    {
        // if(Gate::denies("categories.create")){
        //     abort(403);
        // }
        Gate::authorize("categories.create");
        $categories=Category::orderBy('name')->get();
        $category=new Category();
        return view('dashboard.categories.create',compact('categories','category'));

    }
    public function store(Request $request)
    {
        // dd($request);
        // $category=new Category();
        // $category->name=$request->name;
        // $category->slug=Str::slug($request->name);
        // $category->description=$request->description;
        // $category->parent_id=$request->Category_Parent;
        // $category->save();
        // return redirect()->route('dashboard.categories.index');
        // dd($request);
        $path=null;
        $request->validate($this->rules());
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
        // dd($category);
        return redirect()->route('dashboard.categories.index')->with('success'," Category ($request->name) created successfuly");
    }
    public function edit($id)
    {
        Gate::authorize("categories.update");
        $category=category::find($id);
        $categories=Category::where('id',"<>",$id)->orderBy('name')
        // ->withTrashed() all data as deleted or not 
        ->get();
        
        if(isset($category)){
            return view('dashboard.categories.edit',compact('category','categories'));
        }
        else{
            abort(404);
        }
        
        
    }
    public function update(CategoryRequest $req,$id)
    {
        // $req->validate($this->rules($id),[
        //     'name.required'=>'تأكد من تعبئة حقل الاسم'
        // ]);
        Gate::authorize("categories.update");
        $path=null;
        $old=null;
        if($req->hasFile('image')){
            $file=$req->file('image');
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
            'name'=>$req->name,
            'slug'=>Str::slug($req->name),       
            'parent_id'=>$req->Category_Parent,
            'image'=>$path,
            'description'=>$req->description
        ]);
        if($old){
            (Storage::disk('uploads')->delete($old));
        }
        return redirect()->route('dashboard.categories.index')->with('success'," Category ($req->name) edited successfuly");;
    }
    public function destroy($id)
    {
        Gate::authorize("categories.delete");
        $category=category::withTrashed()->findOrFail($id);
        if(isset($category->deleted_at)){
            $category->forceDelete();
        }
        else{
            $category->delete();
        }
        return redirect()->back()->with('success'," Category ($category->name) deleted successfuly");
    }
    public function trash(){
        $trashed=Category::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('dashboard.categories.trash',compact('trashed'));

    }
    public function restore(Request $req,$id){
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.index')->with('success'," Category ($category->name) restored successfuly");
    }
}
