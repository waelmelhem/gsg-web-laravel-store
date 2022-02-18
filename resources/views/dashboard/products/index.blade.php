@extends('layouts.dashboard')

@section('title', 'products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>

@endsection

@section('content')
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{session()->get('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="get" action="{{route('dashboard.products.index')}}" class="d-flex">
                <input type='text' name='search' value="{{request('search')}}" class="form-control" >
                <input type="submit" value="search" class="btn btn-dark ms-2">
            </form>
        </div>
        <div class="col-md-6">
            <div class="table-tool-part mb-3">
                <a class="btn  btn-outline-primary" href="{{route("dashboard.products.create")}}">Add</a> 
                <a class="btn  btn-outline-success" href="{{route("dashboard.products.trash")}}">Trash</a>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header">
            All Products
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>SKU</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product )
                    <tr>
                        <td>
                            {{-- {{$product->image}} --}}
                            @if($product->image)
                            <div style="margin: auto"><img src="{{ asset('/uploads/'.$product->image)}}" width='60px'> </div>
                            {{-- <div style="margin: auto"><img src="{{ Storage::disk('uploads')->url($product->image)}}" width='60px'> </div> --}}

                            @else
                            <div style="margin: auto"><img src="{{ asset('/default/blank.jpg'.$product->image)}}" width='60px'> </div>          
                            @endif
                        </td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category_id}}</td>
                        <td>{{$product->price}}
                        @if(isset($product->compare_price))
                        <del>{{'|'.$product->compare_price}}</del>
                        @endif
                        </td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->SKU}}</td>
                        <td>{{$product->status}}</td>
                        <td>{{$product->created_at}}</td>
                        <td><a href="{{route('dashboard.products.edit',['product'=>$product->id])}}" class="btn btn-outline-primary">Edit</a>
                        </td>
                        <td>
                        <form method="post" action="{{route('dashboard.products.destroy',["product"=>$product->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                        </td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
                {{-- {{$products->links()}} --}}
            </table>
        </div>


    @endsection
