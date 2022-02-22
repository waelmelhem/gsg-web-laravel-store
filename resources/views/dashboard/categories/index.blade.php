@extends('layouts.dashboard')

@section('title', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>

@endsection

@section('content')
{{-- <x-flash_message></x-flash_message> --}}
<x-flash_message name="success" class="info"/>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="get" action="{{route('dashboard.categories.index')}}" class="d-flex">
                <input type='text' name='search' value="{{request('search')}}" class="form-control" >
                <input type="submit" value="search" class="btn btn-dark ms-2">
            </form>
        </div>
        <div class="col-md-6">
            <div class="table-tool-part mb-3">
                <a class="btn  btn-outline-primary" href="{{route("dashboard.categories.create")}}">Add</a> 
                <a class="btn  btn-outline-success" href="{{route("dashboard.categories.trash")}}">Trash</a>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header">
            All Categories
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
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
                        <td>
                            {{-- {{$category->image}} --}}
                            
                            <div style="margin: auto"><img src="{{ $category->image_url}}" width='60px'> </div>
                        </td>
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
