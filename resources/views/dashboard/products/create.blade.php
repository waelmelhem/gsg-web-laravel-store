@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.products.index') }}">products</a></li>
    <li class="breadcrumb-item active">Create product</li>

@endsection

@section('content')
@include('dashboard.products._error_panel')
<form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
    @include('dashboard.products._form1',['button'=>"Create"])
</form>




@endsection
