$@extends('layouts.dashboard');

@section('title', 'Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Page</li>
@endsection
@section('content')

@endsection
