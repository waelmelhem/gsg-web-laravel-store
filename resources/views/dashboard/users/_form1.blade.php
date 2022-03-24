@csrf
<div class="row">
    <div class="col-md-12">
        <x-form.input id="name" title="{{ trans('Users Name') }}" type="text" name="name" :value="$user->name"/>
        <x-form.input id="email" title="{{ trans('Email') }}" type="email" name="email" :value="$user->email"/>

    </div>
    <div class="col-md-12">
        <h3>{{__("Permissions")}}</h3>
        <div class="row">
            @foreach(App\models\Role::all() as $key =>$value)
            
                <div class="col-md-3">
                    <div class="custom-control custom-switch">
                        {{-- {{dd($user->roles)}} --}}
                        <input type="checkbox" class="custom-control-input" name="roles[]" value="{{$value->id}}" @if(in_array($value->id,$user_roles))checked @endif id="{{$value->id}}">
                        <label class="custom-control-label" for="{{$value->id}}">{{$value->name}}</label>
                    </div>
                
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">{{__($button)}}</button>
        <a class="btn btn-light" href="{{ route('dashboard.users.index') }}">{{__('Cancle')}}</a>
    </div>
</div>