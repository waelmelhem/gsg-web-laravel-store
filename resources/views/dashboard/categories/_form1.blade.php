@csrf
<div class="row">
    <div class="col-md-8">
        <x-form.input id="name" title="{{ trans('Category Name') }}" type="text" name="name" :value="$category->name"/>
        <x-form.select id="Category_Parent" title="{{__('Category Parent')}}" type="list" name="Category_Parent" default="No Parent" selecteValue="{{$category->parent_id}}" :data="$categories"/>
        <x-form.textArea id="Description" title="{{ trans('description') }}" name="description" :value="$category->description"/>
    </div>
    <div class="col-md-4">
        <x-form.image objectimage="{{$category->image_url}}" id="image" title="{{ trans('Image') }}" name="image"/>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">{{__($button)}}</button>
        <a class="btn btn-light" href="{{ route('dashboard.categories.index') }}">{{__('Cancle')}}</a>
    </div>
</div>