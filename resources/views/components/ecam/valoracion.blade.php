@props(['idValoracion'])

@php
    $valoracion = App\Models\Valoracion::with('asignacion.user')->find($idValoracion);
    $comite = $valoracion?->asignacion?->user;
@endphp

<div class="valoracion_wrapper valoracion_wrapper_main">
    <div class="valoracion_puntos square bg-black">{{ $puntos = $valoracion->puntos_total }}</div>
    <div class="valoracion_nombre">{{ strtoupper($comite?->name ?? 'SIN COMITE') }}</div>
</div>
<div class="valoracion_wrapper">
    <div class="valoracion_puntos square">{{ $valoracion->puntos_guion }}</div>
    <div class="valoracion_apartado"><strong>Guion: </strong></div>
    <div class="valoracion_texto">{{ $valoracion->guion }}</div>
</div>
<div class="valoracion_wrapper">
    <div class="valoracion_puntos square">{{ $valoracion->puntos_financiacion }}</div>
    <div class="valoracion_apartado"><strong>Financiacion: </strong></div>
    <div class="valoracion_texto">{{ $valoracion->financiacion }}</div>
</div>
<div class="valoracion_wrapper">
    <div class="valoracion_puntos square">{{ $valoracion->puntos_solicitante }}</div>
    <div class="valoracion_apartado"><strong>Solicitante: </strong></div>
    <div class="valoracion_texto">{{ $valoracion->solicitante }}</div>
</div>
