@csrf
<div class="row">
    <div class="col-md-8">
        <div class="form-groub mb-3">
            <label for="name">Category Name</label>
            <input type="text" id='name' value="{{ old('name',$category->name) }}" name='name'
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">
                    {{$errors->first('name') }}
                </div>
            @enderror
        </div>
        <div class="form-groub mb-3">
            <label for="Category_Parent">Category Parent</label>
            <select type="list" id='Category_Parent' name='Category_Parent'
                class="form-control @error('Category_Parent') is-invalid @enderror">
                <option value="">No Parent</option>
                @foreach ($categories as $parent)
                    <option value="{{ $parent->id }}" @if ($parent->id == old('Category_Parent',$category->parent_id)) selected @endif>{{ $parent->name }}</option>
                @endforeach
            </select>
            @error('Category_Parent')
                <div class="invalid-feedback">
                    {{$errors->first('Category_Parent') }}
                </div>
            @enderror
        </div>
        <div class="form-groub mb-3">
            <label for="Description">Description</label>
            <textarea id='Description' name='Description'
                class="form-control  @error('Description') is-invalid @enderror">{{ old('Description',$category->description) }}</textarea>
            @error('Description')
                <div class="invalid-feedback">
                    {{$errors->first('Description') }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-groub mb-3">
            @if(isset($category->image))
                            <div style="margin:auto"><img src="{{ asset('/uploads/'.$category->image)}}" width='200px'> </div>
                            {{-- <div style="margin: auto"><img src="{{ Storage::disk('uploads')->url($category->image)}}" width='60px'> </div> --}}

                            @else
                            <div style="margin:auto"><img src="{{ asset('/default/blank.jpg'.$category->image)}}" width='200px'> </div>          
                            @endif
            <label for="image">Image</label>
            <input type="file" id='image' name='image' class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">
                    {{$errors->first('image') }}
                </div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">{{$button}}</button>
        <a class="btn btn-light" href="{{ route('dashboard.categories.index') }}">Cancle</a>
    </div>
</div>
