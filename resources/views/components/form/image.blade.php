@props([
    'objectimage'=>null,
    'title'=>'',
    'type'=>'image',
    'id'=>"",
    'name',

])
<div class="form-groub mb-3">
    <div style="margin:auto"><img src="{{$objectimage}}" width='180px'> </div>
    <label for="{{$id}}">{{$title}}</label>
    <input type="file" id='{{$id}}' name='{{$name}}' class="form-control @error($name) is-invalid @enderror">
    @error($name)
        <div class="invalid-feedback">
            {{$errors->first($name) }}
        </div>
    @enderror
    
</div>