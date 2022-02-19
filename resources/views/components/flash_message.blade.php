@props([
    'name'=>'success',
    'class'=>'info'
])
@if(session()->has($name))
<div class="alert alert-{{$class}} alert-dismissible fade show" role="alert">
    <strong> {{session()->get('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif