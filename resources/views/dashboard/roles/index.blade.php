@extends('layouts.dashboard')

@section('title', __('Roles'))

@section('breadcrumb')
    @parent
    <li class=" breadcrumb-item active">{{ __('Roles') }}</li>

@endsection

@section('content')
    {{-- <x-flash_message></x-flash_message> --}}
    <x-flash_message name="success" class="info" />
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="get" action="{{ route('dashboard.roles.index') }}" class="d-flex">
                    <input type='text' name='search' value="{{ request('search') }}" class="form-control">
                    <input type="submit" value="{{ __('search') }}" class="btn btn-dark ms-2">
                </form>
            </div>
            <div class="col-md-6">
                <div class="table-tool-part mb-3">
                    <a class="btn  btn-outline-primary"
                        href="{{ route('dashboard.roles.create') }}">{{ trans('Add') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            @lang('All Roles')
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Permissions #')}}</th>
                        <th>{{__('Users #')}}</th>
                        <th>{{__('Created At')}}</th>
                        <th colspan="2">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ count($role->permissions)}}</td>
                            <td>{{ $role->users_count }}</td>
                            <td>{{ $role->created_at }}</td>

                            <td>
                                @can('roles.update')
                                    <a href="{{ route('dashboard.roles.edit', ['role' => $role]) }}"
                                    class="btn btn-outline-primary">{{ trans('Edit') }}</a>
                                @endcan
                            </td>
                            <td>
                                @can("roles.delete")
                                    <form method="post"
                                        action="{{ route('dashboard.roles.destroy',['role' => $role]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">{{ trans('Delete') }}</button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach

                </tbody>
                {{-- {{$roles->links()}} --}}
            </table>
        </div>


    @endsection
