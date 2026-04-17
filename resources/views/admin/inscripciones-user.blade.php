@php
    $user = App\Models\User::find($id);
    $inscripciones = $user->inscripciones;
@endphp

    @if ($inscripciones != '[]')
        <ul class="nav flex-column">
        @foreach ($inscripciones as $inscripcion)
            <li class="nav-item">
                <a  href="{{ route( 'inscripciones.show', $inscripcion->id ) }}">
                    {{$inscripcion->titulo}}
                </a>
            </li>
            @endforeach
        </ul>
    @endif