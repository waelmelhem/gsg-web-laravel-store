@extends('layouts.dashboard')

@section('title', __('Users'))

@section('breadcrumb')
    @parent
    <li class=" breadcrumb-item active">{{ __('Users') }}</li>

@endsection

@section('content')
    {{-- <x-flash_message></x-flash_message> --}}
    <x-flash_message name="success" class="info" />
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="get" action="{{ route('dashboard.users.index') }}" class="d-flex">
                    <input type='text' name='search' value="{{ request('search') }}" class="form-control">
                    <input type="submit" value="{{ __('search') }}" class="btn btn-dark ms-2">
                </form>
            </div>
            <div class="col-md-6">
                <div class="table-tool-part mb-3">
                    <a class="btn  btn-outline-primary"
                        href="{{ route('dashboard.users.create') }}">{{ trans('Add') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            @lang('All Users')
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{__('User Name')}}</th>
                        <th>{{__('Roles #')}}</th>
                        <th>{{__('Created At')}}</th>
                        <th colspan="2">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ implode(" , ",$user->roles->pluck("name")->toArray())}}</td>
                            <td>{{ $user->created_at }}</td>

                            <td>
                                @can('users.update')
                                    <a href="{{ route('dashboard.users.edit', ['user' => $user]) }}"
                                    class="btn btn-outline-primary">{{ trans('Edit') }}</a>
                                @endcan
                            </td>
                            <td>
                                @can("users.delete")
                                    <form method="post"
                                        action="{{ route('dashboard.users.destroy',['user' => $user]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">{{ trans('Delete') }}</button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach

                </tbody>
                {{-- {{$users->links()}} --}}
            </table>
        </div>


    @endsection
