@extends('layouts.dashboard')

@section('title', __('Create Roles'))

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.roles.index') }}">{{__('Create Roles')}}</a></li>
    <li class="breadcrumb-item active">{{__('Create Roles')}}</li>

@endsection

@section('content')
@include('dashboard.roles._error_panel')
<form action="{{ route('dashboard.roles.store') }}" method="post">
    @include('dashboard.roles._form1',['button'=>"Create"])
</form>




@endsection
