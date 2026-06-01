@props(['value'])

<label {{ $attributes->merge(['class' => 'd-inline-block']) }}>
    {{ $value ?? $slot }}
</label>
