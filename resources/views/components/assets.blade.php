@if (app()->environment('local'))
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="{{ asset('build/css/app.css') }}?v={{ filemtime(public_path('build/css/app.css')) }}">
    <script src="{{ asset('build/js/app.js') }}?v={{ filemtime(public_path('build/js/app.js')) }}" defer></script>
@endif
