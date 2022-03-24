@csrf
<div class="row">
    <div class="col-md-12">
        <x-form.input id="name" title="{{ trans('Roles Name') }}" type="text" name="name" :value="$role->name"/>
    </div>
    <div class="col-md-12">
        <h3>{{__("Permissions")}}</h3>
        <div class="row">
            @foreach(config('permission') as $key =>$value)
            
                <div class="col-md-3">
                    <div class="custom-control custom-switch">
                        {{-- {{dd($role->permissions)}} --}}
                        <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$key}}" @if(in_array($key,$role->permissions))checked @endif id="permission_{{str_replace('.','_',$key)}}">
                        <label class="custom-control-label" for="permission_{{str_replace('.','_',$key)}}">{{$value}}</label>
                    </div>
                
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">{{__($button)}}</button>
        <a class="btn btn-light" href="{{ route('dashboard.roles.index') }}">{{__('Cancle')}}</a>
    </div>
</div>