<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CategoriesController extends Controller
{protected function rules($id=0){
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
        "Description"=>"nullable|string|min:5",
        "image"=>"nullable|image|mimes:png,jpg|max:500|dimensions:min_width=150,min_hegiht=150"
    ];
}
    public function index()
    {
        $categories = Category::leftJoin('categories as parents','parents.id',"categories.parent_id")
        ->select(['categories.*',
        'parents.name as parent_name'
        ])
        // ->whereNull('categories.parent_id')
        ->orderBy('categories.name')
        ->get();
        // dd($categories);
        return view('dashboard/categories/index',compact('categories'));
    }
    public function create()
    {

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
        $request->validate($this->rules());
        $category= Category::create($this->rules);
        // dd($category);
        return redirect()->route('dashboard.categories.index');
   
    }
    public function edit($id)
    {
        $category=category::find($id);
        $categories=Category::where('id',"<>",$id)->orderBy('name')->get();
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
        $category=category::where("id",$id)->update([
            'name'=>$req->name,
            'slug'=>Str::slug($req->name),
            'parent_id'=>$req->Category_Parent,
            'description'=>$req->Description
        ]);
        return redirect()->route('dashboard.categories.index');
    }
    public function destroy($id)
    {
        $category=category::findOrFail($id);
        
        $category->delete();
        return redirect()->back();
    }
}
