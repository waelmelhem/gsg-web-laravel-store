@extends("layouts.dashboard")

@section('title',"User Profile")
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">User Profile</li>

@endsection
@section('content')
<x-flash_message/>
<form method="post" action="{{route('profile.update',['id'=>"$user->id"])}}" >
    @csrf 
    @method('patch')
    <x-form.input name="name" :value="$user->name" title="Name"/>
    <x-form.input name="email" :value="$user->email" title="Email"/>
    <input type="submit" value="update" class="btn btn-primary">
    <a href="{{url('change_password')}}" class="btn btn-danger" >Change password</a>

</form>
@endsection
