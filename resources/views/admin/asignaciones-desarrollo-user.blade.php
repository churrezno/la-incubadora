@php
    $user = App\Models\User::find($id);
    $asignaciones = $user->asignaciones->where('asignable_type', 'App\Models\Inscripcion');
@endphp

    @if ($asignaciones->isNotEmpty())
        <ul class="nav flex-column">
        @foreach ($asignaciones as $asignacion)
            <li class="nav-item">
                {{ $asignacion->asignable->titulo }}
            </li>
        @endforeach
        </ul>
    @endif