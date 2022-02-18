@extends('layouts.dashboard')

@section('title', 'Products Trash')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.products.index') }}">products</a></li>
    <li class="breadcrumb-item active">Trash</li>

@endsection

@section('content')
<div class="table-tool-part mb-3" >
    <a class="btn  btn-outline-primary" href="{{route("dashboard.products.create")}}">Add</a> 
    <a class="btn  btn-outline-success" href="{{route("dashboard.products.index")}}">Back</a>
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
                        <th>Deleted At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashed as $product )
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
                        <td>{{$product->deleted_at}}</td>
                        <td>
                            <form method="post" action="{{route('dashboard.products.restore',['id'=>$product->id])}}">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-outline-success">Restore</button>
                                </form>
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
