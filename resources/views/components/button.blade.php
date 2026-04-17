<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-rojo']) }}>
    {{ $slot }}
</button>
