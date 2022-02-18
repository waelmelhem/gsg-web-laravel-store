@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.products.index',$product->id) }}">products</a></li>
    <li class="breadcrumb-item active">Edit product</li>

@endsection


@section('content')
@include('dashboard.products._error_panel')
    <form action="{{ route('dashboard.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
        @method("put")
        @include('dashboard.products._form1',['button'=>"Update"])
    </form>




@endsection
