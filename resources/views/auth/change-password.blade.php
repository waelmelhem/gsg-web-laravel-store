@extends("layouts.dashboard")

@section('title',"User Profile")
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Password</li>

@endsection
@section('content')
<x-flash_message/>
<form method="post" action="{{route('change_passwrod.update')}}" >
    @csrf 
    @method('put')
    <x-form.input type="password" name="password"  title="Current Password"/>
    <x-form.input type="password" name="new_password"  title="New Password"/>
    <x-form.input type="password" name="new_password_confirmation"  title="Confirm Password"/>
    <input type="submit" value="Change Password" class="btn btn-primary">

</form>
@endsection
