@props([
    'title'=>null,'id'=>null,"name",'type'=>'text','value'=>'','required'=>null
])
@php 
$id = $id??$name;
@endphp
<div class="form-groub mb-3">
    @if($title)
    <x-form.label required="{{$required}}" for="{{$id}}">{{$title}}</x-form.label>
    @endif
    <input type="{{$type}}" setp="1"  name="{{$name}}" value="{{ old($name,$value) }}" {{$attributes->class(['form-control',"is-invalid"=>$errors->has($name)])}}">
    @error($name)
        <div class="invalid-feedback">
            {{$errors->first($name) }}
        </div>
    @enderror
</div>