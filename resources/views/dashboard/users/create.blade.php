@extends('layouts.dashboard')

@section('title', __('Create Users'))

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.users.index') }}">{{__('Create Users')}}</a></li>
    <li class="breadcrumb-item active">{{__('Create Users')}}</li>

@endsection

@section('content')
@include('dashboard.users._error_panel')
<form action="{{ route('dashboard.users.store') }}" method="post">
    @include('dashboard.users._form1',['button'=>"Create"])
</form>




@endsection
