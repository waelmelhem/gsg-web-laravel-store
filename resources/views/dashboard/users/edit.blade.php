@extends('layouts.dashboard')

@section('title', 'Edit Role')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Users</li>

@endsection


@section('content')
@include('dashboard.users._error_panel')
    <form action="{{ route('dashboard.users.update',$user) }}" method="post">
        @method("put")
        @include('dashboard.users._form1',['button'=>"Update"])
    </form>




@endsection
