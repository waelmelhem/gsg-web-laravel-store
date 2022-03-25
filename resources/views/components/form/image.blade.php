@props([
    'objectimage'=>null,
    'title'=>'',
    'type'=>'image',
    'id'=>"",
    'name',
    "multiple"=>"",
    "gallery"=>[]

])
<div class="form-groub mb-3">
    <div style="margin:auto">
        <img src="{{$objectimage}}" width='180px'> 
    </div>
    <div class="row">
        
        @foreach ($gallery as $key=>$url)
        {{-- {{dd($gallery)}} --}}
        <div class="col-md-4">
            <img src="{{$url}}" width="100px">
            <label class="text-danger"><input type="checkbox" name="delete_media[]" value="{{$key}}">delete</label>

        </div>
    @endforeach
    </div>
    <label for="{{$id}}">{{$title}}</label>
    <input {{$multiple}} type="file" id='{{$id}}' name='{{$name}}' class="form-control @error($name) is-invalid @enderror">
    @error($name)
        <div class="invalid-feedback">
            {{$errors->first($name) }}
        </div>
    @enderror
    
</div>