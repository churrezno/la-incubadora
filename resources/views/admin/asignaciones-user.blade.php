@php
    $user = App\Models\User::find($id);
    $asignaciones = $user->asignaciones;
@endphp

    @if ($asignaciones != '[]')
        <ul class="nav flex-column">
        @foreach ($asignaciones as $asignacion)
            <li class="nav-item">
                    {{$asignacion->inscripcion->titulo}}
            </li>
            @endforeach
        </ul>
    @endif