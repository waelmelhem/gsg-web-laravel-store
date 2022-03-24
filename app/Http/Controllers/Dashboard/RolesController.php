<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:roles.view")->only('index');
        $this->middleware("can:roles.update")->only(['update','edit']);
        $this->middleware("can:roles.delete")->only(['destroy']);
        $this->middleware("can:roles.create")->only(["create"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::withCount('users')->paginate();
        return view("dashboard.roles.index",[
            'roles'=>$roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=new Role();
        $user_roles=[];
        $role->permissions=[];
        return view("dashboard.roles.create",[
            'role'=>$role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            "permissions"=>"required|array"
        ]);
        $role=Role::create($request->all());
        // dd(Role::all());
        return redirect()->route("dashboard.roles.index")->with("success",__('Role ":name"created',[
            "name"=>$role['name']
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        
        return view("dashboard.roles.edit",[
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $role)
    {
        $request->validate([
            'name'=>"required",
            "permissions"=>"required|array"
        ]);
        $role->update($request->all());
        return redirect()->route("dashboard.roles.index")->with("success",__('Role ":name"created',[
            "name"=>$role['name']
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $roleD=$role->delete();
        return redirect()->route("dashboard.roles.index")->with("success",__('Role ":name"delated',[
            "name"=>$role['name']
        ]));
    }
}
