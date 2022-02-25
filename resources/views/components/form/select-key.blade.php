@props([
    'title'=>null,'id'=>null,"name",'type'=>'text','value'=>'',"default"=>'Select one','selecteValue'=>null,'data'=>[]
])
@php 
$id = $id??$name;
@endphp
<div class="form-groub mb-3">
    @if($title)
    <label for="{{$id}}">{{$title}}</label>
    @endif
    {{-- <input type="{{$type}}" setp="1"  name="{{$name}}" value="{{ old($name,$value) }}" {{$attributes->class(['form-control',"is-invalid"=>$errors->has($name)])}}"> --}}
    <select type="list" id='{{$id}}' name='{{$name}}'
    class="form-control @error($name) is-invalid @enderror">
    <option value="">{{$default}}</option>
    @foreach ($data as $key=> $item)
        <option value="{{ isset($item->id)?$item->id:$key }}" @if ((isset($item->id)?$item->id:$key) == old($name,$selecteValue)) selected @endif>{{ (isset($item->name)?$item->name:$item) }}</option>
    @endforeach
</select>
    @error($name)
        <div class="invalid-feedback">
            {{$errors->first($name) }}
        </div>
    @enderror
</div>