@csrf
<div class="row">
    <div class="col-md-8">
        {{-- @ php($product=new App\Model\Product()) --}}
        <div class="form-groub mb-3">
            <label for="name">Product Name</label>
            <input type="text" id='name' value="{{ old('name',$product->name) }}" name='name'
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">
                    {{$errors->first('name') }}
                </div>
            @enderror
        </div>
        <div class="form-groub mb-3">
            <label for="category_id">Category</label>
            <select type="list" id='category_id' name='category_id'
                class="form-control @error('category_id') is-invalid @enderror">
                <option value="">select one</option>
                @foreach (App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" @if ($category->id == old('category_id',$product->category_id)) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">
                    {{$errors->first('category_id') }}
                </div>
            @enderror
        </div>
        <div class="form-groub mb-3">
            <label for="Description">Description</label>
            <textarea id='Description' name='description'
                class="form-control  @error('Description') is-invalid @enderror">{{ old('Description',$product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{$errors->first('description') }}
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-groub mb-3">
                    <label for="price">price</label>
                    <input type="number"class="form-control  @error('price') is-invalid @enderror" step="0.1" id="price" name="price" value="{{ old('price',$product->price) }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{$errors->first('price') }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-groub mb-3">
                    <label for="compare_price">Compare Price</label>
                    <input setp="0.1" type="number"  class="form-control  @error('compare_price') is-invalid @enderror" id="compare_price" name="compare_price" value="{{ old('compare_price',$product->compare_price) }}">
                    @error('compare_price')
                        <div class="invalid-feedback">
                            {{$errors->first('compare_price') }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-groub mb-3">
                    <label for="cost">cost</label>
                    <input type="number" step="0.1"class="form-control  @error('cost') is-invalid @enderror" id="cost" name="cost" value="{{ old('cost',$product->cost) }}">
                    @error('cost')
                        <div class="invalid-feedback">
                            {{$errors->first('cost') }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-groub mb-3">
                    <label for="quantity">quantity</label>
                    <input type="number" setp="1" class="form-control  @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity',$product->quantity) }}">
                    @error('quantity')
                        <div class="invalid-feedback">
                            {{$errors->first('quantity') }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-groub mb-3">
                    <label for="availability">Availability</label>
                    <select type="list" id='availability' name='availability'class="form-control @error('availability') is-invalid @enderror">
                        <option value="" selected>select one</option>
                        @foreach ( $availability as $element)
                            <option value="{{ $element }}" @if ($element == old('availability',$product->availability)) selected @endif>{{ $element }}</option>
                        @endforeach
                    </select>
                    @error('availability')
                    <div class="invalid-feedback">
                        {{$errors->first('availability') }}
                    </div>
                    @enderror
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-groub mb-3">
                    <label for="SKU">SKU</label>
                    <input  type="text"  class="form-control  @error('SKU') is-invalid @enderror" id="SKU" name="SKU" value="{{ old('SKU',$product->SKU) }}">
                    @error('SKU')
                        <div class="invalid-feedback">
                            {{$errors->first('SKU') }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-groub mb-3">
                    <label for="barcode">Barcode</label>
                    <input type="text" class="form-control  @error('barcode') is-invalid @enderror" id="barcode" name="barcode" value="{{ old('barcode',$product->barcode) }}">
                    @error('cost')
                        <div class="invalid-feedback">
                            {{$errors->first('cost') }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-groub mb-3">
            <label for="status">Status</label>
                    <select type="list" id='status' name='status'class="form-control @error('status') is-invalid @enderror">
                        <option value="" selected>select one</option>
                        @foreach ( $status as $element)
                            <option value="{{ $element }}" @if ($element == old('status',$product->status)) selected @endif>{{ $element }}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{$errors->first('status') }}
                    </div>
                    @enderror
        </div>
        <div class="form-groub mb-3">
            @if(isset($product->image))
                            <div style="margin:auto"><img src="{{ asset('/uploads/'.$product->image)}}" width='200px'> </div>
                            {{-- <div style="margin: auto"><img src="{{ Storage::disk('uploads')->url($product->image)}}" width='60px'> </div> --}}
                            @else
                            <div style="margin:auto"><img src="{{ asset('/default/blank.jpg'.$product->image)}}" width='180px'> </div>          
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