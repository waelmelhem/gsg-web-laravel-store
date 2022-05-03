@extends('layouts.dashboard')

@section('title', __('Settings'))

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ __('Settings') }}</li>

@endsection

@section('content')
<form method="post" action="{{route('dashboard.settings.update')}}">
@csrf
@method('patch')

<x-form.input id="name" title="{{ trans('app_name') }}" type="text" name="app_name" :value="$settings['app_name']"/>


<x-form.select-key id="app_currency" title="app_currency" type="list" name="app_currency" default="Select one" :data="$currencies" selecteValue="{{$settings['app_currency']}}"/>
{{-- {{dd($locales)}} --}}
<x-form.select-key id="app_locale" title="app_locale" type="list" name="app_locale" default="Select one" :data="$locales" selecteValue="{{$settings['app_locale']}}"/>
<x-form.input id="app_ipStack" title="{{ trans('app_ipStack') }}" type="text" name="app_ipStack" :value="$settings['app_ipStack']"/>

<input type="submit" value="save" class="btn btn-outline-danger">
</form>
@endsection
