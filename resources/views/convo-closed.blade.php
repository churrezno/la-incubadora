@php
    $user = auth()->user();
@endphp

<x-app-layout>

    <x-alert />

    <h1>Hola, {{ auth()->user()->name }}</h1>
    <h4 class="mt-4 mb-3">La convocatoria de La Incubadora 10 está cerrada.</h4>
    
    <p class="m-0">Puedes seguir las novedades de la Incubadora <a class="txt-rojo" href="https://ecam-industria.es/la-incubadora/" target="_blank">aquí.</a></p>

</x-app-layout>
