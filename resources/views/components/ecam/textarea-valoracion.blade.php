@props([
    'name',
    'label',
    'old_data' => false,
])

<label for="{{ $name }}">{{ $label }}</label>
<textarea 
    class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
    placeholder="Escribe tu valoracion sobre {{ $label }}"
    id="{{ $name }}"
    name="{{ $name }}"
    style="height: 200px">{{ old( $name , $old_data ? $old_data : '') }}</textarea>

<x-ecam.error name="{{ $name }}" />