@php
    $user = App\Models\User::find($id);
    $asignaciones = $user->asignaciones;
@endphp

    @if ($asignaciones != '[]')
        <ul class="nav flex-column">
        @foreach ($asignaciones as $asignacion)
            <li class="nav-item">
                @if ($asignacion->asignable_type === 'App\Models\Slate')
                    Slate #{{ $asignacion->asignable_id }}
                @elseif ($asignacion->inscripcion)
                    {{ $asignacion->inscripcion->titulo }}
                @endif
            </li>
            @endforeach
        </ul>
    @endif