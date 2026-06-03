@props(['idValoracion'])

@php
    $valoracion = App\Models\ValoracionSlate::with('asignacion.user')->find($idValoracion);
    $comite = $valoracion?->asignacion?->user;
@endphp

<div class="valoracion_wrapper valoracion_wrapper_main">
    <div class="valoracion_puntos square bg-black">{{ $puntos = $valoracion->puntos }}</div>
    <div class="valoracion_nombre">{{ strtoupper($comite?->name ?? 'SIN COMITE') }}</div>
</div>
<div class="valoracion_wrapper" style="margin-left: 44px;">
    <div class="valoracion_apartado"><strong>Comentarios: </strong></div>
    <div class="valoracion_texto">{{ $valoracion->comentarios }}</div>
</div>