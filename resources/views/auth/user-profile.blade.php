@extends("layouts.dashboard")

@section('title',"User Profile")
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">User Profile</li>

@endsection
@section('content')
<x-flash_message/>
{{-- @php(dd($user->profile)) --}}

<form method="post" action="{{route('profile.update',['id'=>"$user->id"])}}" >
    @csrf 
    @method('patch')
    <x-form.input name="name" :value="$user->name" title="Display Name"/>
    <x-form.input name="email" :value="$user->email" title="Email"/>
    <div class="row">
        <div class="col-6">
            <x-form.input name="first_name" :value="$user->profile->first_name" title="First Name"/>
        </div>
        <div class="col-6">
            <x-form.input name="last_name" :value="$user->profile->last_name" title="Last Name"/>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <x-form.input type='date' name="brithday" :value="$user->profile->brithday" title="Brithday"/>
        </div>
        <div class="col-6">
            <x-label>Gender</x-label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    
                    <input name='gender' id='male' value='male' type="radio" class="form-check-input" @if($user->profile->gender=='male') checked @endif>
                    <label class='form-check-label' for="male" >Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name='gender' id='female' value='female' type="radio" @if($user->profile->gender=='female') checked @endif class="form-check-input">
                    <label class='form-check-label' for="female" >Female</label>
                </div>
                
            </div>
        </div>
    </div>
    <x-form.textArea id="address" title="address" name="address" :value="$user->profile->address"/>
    <div class="row">
        <div class="col-6">
            <x-form.input name="city" :value="$user->profile->city" title="city"/>
        </div>
        <div class="col-6">
            {{-- @php(dd($user->profile->country_code)) --}}
            <x-form.select-key id="country_code" title="Country Code" type="list" name="country_code" default="select one" selecteValue="{{$user->profile->country_code}}" :data="Symfony\Component\Intl\Countries::getNames()"/>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <x-form.select-key id="language" title="Language" type="list" name="locale" default="select one" selecteValue="{{$user->profile->locale}}" :data="Symfony\Component\Intl\Locales::getNames()"/>
        </div>
        <div class="col-6">
            <x-form.select-key id="timezone" title="timezone" type="list" name="timezone" default="select one" selecteValue="{{$user->profile->timezone}}" :data="Symfony\Component\Intl\TimeZones::getNames()"/>
        </div>
    </div>
    <input type="submit" value="update" class="btn btn-primary">
    <a href="{{url('change_password')}}" class="btn btn-danger" >Change password</a>

</form>
@endsection
