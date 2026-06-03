@php
    $slate = App\Models\Slate::find($id);
    $valoracionesSlate = $slate->valoracionesSlate;
    $asignaciones = $slate->asignaciones;
    $user = auth()->user();
@endphp

<div class="d-flex">
    @if ($user && $user->hasRole('admin'))
        <div class="square-big puntos_total">{{ $slate->puntuacion_total() }}</div>
    @endif
    
    {{-- Valoraciones vacías --}}
    @if ($asignaciones != '[]')
        @foreach ($asignaciones as $asignacion)
            {{-- Sólo visible para admin o current user --}}
            @if (isset($user) && ($user->hasRole('admin') || $asignacion->user_id == $user->id))
                @if ( !($valoracionesSlate->pluck('asignacion.user_id'))->contains($asignacion->user_id) )
                    @php
                        $userSinValoracion = App\Models\User::find($asignacion->user_id)
                    @endphp
                    <div class="valoracion_mini_wrapper">
                        <div class="valoracion_iniciales">{{ $userSinValoracion->userInitials() }}</div>
                        <div class="valoracion_puntos">-</div>
                    </div>
                @endif 
            @endif      
        @endforeach            
    @endif
    
    {{-- Valoraciones rellenas --}}
    @if ($valoracionesSlate != '[]')
        @foreach ($valoracionesSlate as $valoracion)
            {{-- Sólo visible para admin o current user --}}
            @if (isset($user) && ($user->hasRole('admin') || $valoracion->asignacion?->user_id == $user->id))
                <div class="valoracion_mini_wrapper">
                    <div class="valoracion_iniciales">{{ $valoracion->asignacion?->user?->userInitials() }}</div>
                    <div class="valoracion_puntos">{{ $valoracion->puntos }}</div>
                </div>
            @endif
        @endforeach            
    @endif
</div>
