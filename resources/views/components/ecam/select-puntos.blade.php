@props([
    'name',
    'label',
    'old_data' => false,
])


<label for="{{ $name }}">{{ $label }}</label>
<select name="{{ $name }}"
    id="{{ $name }}"
    class="form-select select-puntos"
    style="width: 100px;">
        <option value="">--</option>
        @for ( $i = 0; $i < 10.5; $i += 0.5 )
        <option value={{ $i }} {{ $old_data == $i ? 'selected' : '' }}>{{ $i }}</option>    
        @endfor
</select>

{{-- <div class="form-floating">
    <select name="{{ $name }}"
    id="{{ $name }}"
    class="form-select select-puntos"
    style="width: 100px;">
        <option value="">--</option>
        @for ( $i = 0; $i < 10.5; $i += 0.5 )
        <option value={{ $i }} {{ $old_data == $i ? 'selected' : '' }}>{{ $i }}</option>    
        @endfor
    </select>
    <label for="{{ $name }}">{{ $label }}</label>
</div> --}}

<x-ecam.error name="{{ $name }}" />