@props(
    ['required'=>false]
)
<label {{$attributes->class(['form-label','required'=>true])}}>{{$slot}}</label>
