@props([
        'type'=>'select' , 'name' , 'options', 'selected' , 'label'=>false ,'title'=>false
])
<x-form.label for="description">{{$label}}</x-form.label>

    <select name="{{$name}}" class="form-control form-select">
        <option value="">{{$title ?? 'Primary Category'}}</option>
        @foreach($options as $value =>$text)
            <option value="{{$value}}" @selected(old($name ,$value) == $selected) >{{$text }}</option>
        @endforeach
    </select>
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
