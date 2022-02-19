@csrf
<div class="row">
    <div class="col-md-8">
        {{-- @ php($product=new App\Model\Product()) --}}
        <x-form.input id="name" title="Product Name" type="text" name="name" :value="$product->name"/>
        <x-form.select id="category_id" title="Category" type="list" name="category_id" default="select one" selecteValue="{{$product->category_id}}" :data="App\Models\Category::all()"/>
            <x-form.textArea id="Description" title="Description" name="description" :value="$product->description"/>
        <div class="row">
            <div class="col-md-4">
                <x-form.input id="price" title="Price" step="0.1" type="number" name="price" :value="$product->price"/>
            </div>
            <div class="col-md-4">
                <x-form.input id="compare_price"  step="0.1" title="Compare Price" type="number" name="compare_price" :value="$product->compare_price"/>
            </div>
            <div class="col-md-4">
                <x-form.input id="cost" title="Cost" step="0.1" type="number" name="cost" :value="$product->cost"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-form.input required="1" id="quantity" title="Quantity" type="number" name="quantity" :value="$product->quantity"/>
            </div>
            <div class="col-md-6">
                <x-form.select id="availability" title="Availability" type="list" name="availability" default="Select one" selecteValue="{{$product->availability}}" :data="$availability"/>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-form.input id="SKU" title="SKU" type="text" name="SKU" :value="$product->SKU"/>
            </div>
            <div class="col-md-6">
                <x-form.input id="barcode" title="Barcode" type="text" name="barcode" :value="$product->barcode"/>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <x-form.select id="status" title="Status" type="list" name="status" default="Select one" selecteValue="{{$product->status}}" :data="$status"/>
        <x-form.image objectimage="{{$product->image}}" id="image" title="Image" name="image"/>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">{{$button}}</button>
        <a class="btn btn-light" href="{{ route('dashboard.categories.index') }}">Cancle</a>
    </div>
</div>