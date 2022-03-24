@extends('layouts.dashboard')

@section('title', 'Edit Role')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Roles</li>

@endsection


@section('content')
@include('dashboard.roles._error_panel')
    <form action="{{ route('dashboard.roles.update',$role) }}" method="post">
        @method("put")
        @include('dashboard.roles._form1',['button'=>"Update"])
    </form>




@endsection
