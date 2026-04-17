@props([
    'disabled' => false,
    'readonly' => false,
    'old_data' => false,
    'required' => false,
    'type',
    'name',
    'label',
    'class' => '',
    'input_class' => ''
])

<div class="form-floating {{ $class }}">
    <input {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        type="{{ $type }}"
        class="form-control {{ $input_class }} {{ $errors->has($name) ? 'is-invalid' : '' }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old( $name , $old_data ? $old_data : '') }}"
        placeholder="{{ $name }}" />
    <label for="{{ $name }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label>
</div>

<x-ecam.error name="{{ $name }}" />