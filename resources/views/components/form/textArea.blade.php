@props([
    'title'=>null,'id'=>null,"name",'type'=>'text','value'=>'',
])
@php 
$id = $id??$name;
@endphp
<div class="form-groub mb-3">
    @if($title)
    <label for="{{$id}}">{{$title}}</label>
    @endif
    <textarea type="{{$type}}" setp="1"  name="{{$name}}" {{$attributes->class(['form-control',"is-invalid"=>$errors->has($name)])}}>{{old('description',$value)}}</textarea>
    @error($name)
        <div class="invalid-feedback">
            {{$errors->first($name) }}
        </div>
    @enderror
</div>