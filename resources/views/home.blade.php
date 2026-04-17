@php
    $user = auth()->user();
    $inscripciones = $user->inscripciones;
@endphp

<x-app-layout>

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>        
    @endif

    <h1>Hola, {{ auth()->user()->name }}</h1>
    <h4 class="mt-4 mb-3">Te damos la bienvenida a la 9ª edición de La Incubadora</h4>
    
    <p class="m-0">Aquí podrás inscribir tu proyecto de largometraje.</p>
    <p>Te recordamos que podrás presentar un máximo de <span class="text-decoration-underline">dos</span> proyectos, pero antes te animamos a revisar las <a class="txt-rojo" href="/bases" target="_blank">bases de la convocatoria.</a></p>

    @role('solicitante')

        <div class="mt-3">
            <a href="{{ route('inscripciones.create.step.one') }}" class="btn btn-rojo fs-5 mt-3">Inscribe tu proyecto</a>
        </div>

    @endrole


    @role('inscrito|admin')

        <h3 class="mt-5 mb-3">Tus inscripciones:</h3>
        
        <div class="row g-4">
            @foreach ( $inscripciones as $inscripcion )
                <div class="col col-md-4">
                    <div class="card h-100">
                        <div class="image-wrapper">
                            @php
                                $imageUrl = Storage::url('/images/portada_default.jpg');
                                if( $portada = $inscripcion->archivos()->where('archivo_tipo_id', 1)->first() )
                                    $imageUrl = Storage::url($portada->url);
                            @endphp
                            <img src="{{ $imageUrl }}" class="portada" alt="Portada">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title mb-3">{{ $inscripcion->titulo }}</h3>
                            <div class="d-flex flex-column">
                                <a class="btn btn-filter mb-3" href="/inscripcion/{{ $inscripcion->id }}">Ver inscripción</a>
                                @if ( !$inscripcion->complete )
                                    <a class="btn btn-rojo mt-0" href="/inscripciones/create-step-one/{{ $inscripcion->id }}">Completar inscripción</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col">
                @if ( $numInscripcionesUser < 2 )                    
                    <a href="{{ route('inscripciones.create.step.one') }}" class="btn btn-rojo fs-5">Quiero inscribir otro proyecto</a>
                @endif
            </div>
        </div>

    @endrole

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stop

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: '¡Enviado!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: "#a4dd78"
                });
            });
        </script>
    @endif

</x-app-layout>