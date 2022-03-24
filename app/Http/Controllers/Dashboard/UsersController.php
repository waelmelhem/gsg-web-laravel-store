<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("can:users.view")->only('index');
        $this->middleware("can:users.update")->only(['update','edit']);
        $this->middleware("can:users.delete")->only(['destroy']);
        $this->middleware("can:users.create")->only(["create"]);
    }
    public function index()
    {
        
        $users=User::with("roles")->paginate();
        return view("dashboard.users.index",[
            'users'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_roles=[];
        $user=new User();
        return view("dashboard.users.create",[
            'user'=>$user,
            "user_roles"=>$user_roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {
        $user=$user->create($request->all());
        $user->roles()->attach($request->post('roles'));

        $request->validate([
            'name'=>"required",
            "roles"=>"required|array"
        ]);
        $user=User::created($request->all());
        return redirect()->route("dashboard.users.index")->with("success",__('User ":name"created',[
            "name"=>$user['name']
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
    public function edit(User $user)
    {
        // dd($user->permissions);
        $user_roles=$user->roles()->pluck('id')->toArray();
        return view("dashboard.users.edit",[
            'user'=>$user,
            'user_roles'=>$user_roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user->roles()->sync($request->post('roles'));
        $request->validate([
            'name'=>"required",
            "roles"=>"required|array"
        ]);
        $user->update($request->all());
        return redirect()->route("dashboard.users.index")->with("success",__('User ":name"created',[
            "name"=>$user['name']
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $userD=$user->delete();
        return redirect()->route("dashboard.users.index")->with("success",__('User ":name"delated',[
            "name"=>$user['name']
        ]));
    }
}
