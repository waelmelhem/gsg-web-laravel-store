@props([
    'objectimage'=>null,
    'title'=>'',
    'type'=>'image',
    'id'=>"",
    'name',

])
<div class="form-groub mb-3">
    @if($objectimage!=null)
        <div style="margin:auto"><img src="{{ asset('/uploads/'.$objectimage)}}" width='180px'> </div>
        {{-- <div style="margin: auto"><img src="{{ Storage::disk('uploads')->url($category->image)}}" width='60px'> </div> --}}

    @else
        <div style="margin:auto"><img src="{{ asset('/default/blank.jpg')}}" width='180px'> </div>          
    @endif
    <label for="{{$id}}">{{$title}}</label>
    <input type="file" id='{{$id}}' name='{{$name}}' class="form-control @error($name) is-invalid @enderror">
    @error($name)
        <div class="invalid-feedback">
            {{$errors->first($name) }}
        </div>
    @enderror
    
</div>