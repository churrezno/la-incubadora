@props([
    'name',
    'label',
    'description' => '',
    'class' => '',
    'visibility' => '',
    'old_data' => false,
    'required' => false,
])

<div id="wrapper_{{ $name }}" class="form-group {{ $visibility }}">
    <h5 class="{{ $class }}"><label for="{{ $name }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label></h5>
    <p>{{ $description }}</p>
    <textarea
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
        {{-- placeholder="Escribe tu valoracion sobre {{ $label }}" --}}
        id="{{ $name }}"
        name="{{ $name }}">{{ old( $name , $old_data ? $old_data : '') }}</textarea>
        <div class="ck__controls">
            <span class="ck__words"></span>
            <svg class="ck__chart" viewbox="0 0 60 60" width="60" height="60" xmlns="http://www.w3.org/2000/svg">
                <circle stroke="hsl(0, 0%, 93%)" stroke-width="3" fill="none" cx="30" cy="30" r="26" />
                <circle class="ck__chart__circle" stroke="hsl(202, 92%, 59%)" stroke-width="3" stroke-dasharray="134,534" stroke-linecap="round" fill="none" cx="30" cy="30" r="26" />
                <text class="ck__chart__characters" x="50%" y="50%" dominant-baseline="central" text-anchor="middle"></text>
            </svg>
        </div>
</div>

<x-ecam.error name="{{ $name }}" />