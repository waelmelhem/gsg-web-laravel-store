@extends('layouts.dashboard')

@section('title', __('Create Categories'))

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.categories.index') }}">{{__('Create Categories')}}</a></li>
    <li class="breadcrumb-item active">{{__('Create Categories')}}</li>

@endsection

@section('content')
@include('dashboard.categories._error_panel')
<form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
    @include('dashboard.categories._form1',['button'=>"Create"])
</form>




@endsection
