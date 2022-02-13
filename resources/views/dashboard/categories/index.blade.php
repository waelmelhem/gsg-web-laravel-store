@extends('layouts.dashboard')

@section('title', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>

@endsection

@section('content')
<div class="table-tool-part mb-3" >
    <a class="btn  btn-outline-primary" href="{{route("dashboard.categories.create")}}">Add</a>
</div>
    <div class="card">
        <div class="card-header">
            All Categories
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Created At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category )
                    <tr>
                        <td></td>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->parent_name}}</td>
                        <td>{{$category->created_at}}</td>
                        <td><a href="{{route('dashboard.categories.edit',['id'=>$category->id])}}" class="btn btn-outline-primary">Edit</a>
                        </td>
                        <td>
                        <form method="post" action="{{route('dashboard.categories.destroy',["id"=>$category->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
                {{-- {{$categories->links()}} --}}
            </table>
        </div>


    @endsection
