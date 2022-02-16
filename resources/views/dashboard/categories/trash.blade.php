@extends('layouts.dashboard')

@section('title', 'Categories Trash')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.categories.index') }}">categories</a></li>
    <li class="breadcrumb-item active">Trash</li>

@endsection

@section('content')
<div class="table-tool-part mb-3" >
    <a class="btn  btn-outline-primary" href="{{route("dashboard.categories.create")}}">Add</a> 
    <a class="btn  btn-outline-success" href="{{route("dashboard.categories.index")}}">Back</a>
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
                        <th>Deleted At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashed as $category )
                    <tr>
                        <td>
                            {{-- {{$category->image}} --}}
                            @if($category->image)
                            <div style="margin: auto"><img src="{{ asset('/uploads/'.$category->image)}}" width='60px'> </div>
                            {{-- <div style="margin: auto"><img src="{{ Storage::disk('uploads')->url($category->image)}}" width='60px'> </div> --}}
                            @else
                            <div style="margin: auto"><img src="{{ asset('/default/blank.jpg'.$category->image)}}" width='60px'> </div>          
                            @endif
                        </td>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->deleted_at}}</td>
                        <td>
                            <form method="post" action="{{route('dashboard.categories.restore',['id'=>$category->id])}}">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-outline-success">Restore</button>
                                </form>
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
