@props([
    'name',
    'label',
    'old_data' => false,
    'required' => false,
])

@php    
    $generos = array("Comedia", "Drama", "Comedia dramática", "Terror", "Thriller", "Fantástico", "Documental", "Experimental", "Otro");
@endphp


<div class="form-floating">
    <select name="{{ $name }}"
    id="{{ $name }}"
    class="form-select">
        <option value="">- Selecciona -</option>
        @foreach ($generos as $genero)
        <option value={{ $genero }} {{ $old_data == $genero ? 'selected' : '' }}>{{ $genero }}</option>
        @endforeach
    </select>
    <label for="{{ $name }}" class="{{ $required ? 'required' : '' }}">{{ $label }}</label>
</div>

<x-ecam.error name="{{ $name }}" />