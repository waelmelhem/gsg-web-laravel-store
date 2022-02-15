@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.categories.index',$category->id) }}">categories</a></li>
    <li class="breadcrumb-item active">Edit Categories</li>

@endsection


@section('content')
@include('dashboard.categories._error_panel')
    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
        @method("put")
        @include('dashboard.categories._form1',['button'=>"Update"])
    </form>




@endsection
