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
    <h4 class="mt-4 mb-3">Te damos la bienvenida a La Incubadora 10</h4>

    @role('solicitante')

        <p class="m-0">Aquí podrás inscribir tu proyecto de largometraje.</p>
        <p>Te recordamos que podrás presentar un máximo de <span class="text-decoration-underline">dos</span> proyectos, pero antes te animamos a revisar las <a class="txt-rojo" href="/bases" target="_blank">bases de la convocatoria.</a></p>
        
        <div class="mt-3">
            <a href="{{ route('inscripciones.create.step.one') }}" class="btn btn-rojo fs-5 mt-3">Inscribe tu proyecto</a>
        </div>
        
    @endrole
        
        
    @role('slate')
        @if ($numSlatesUser > 0)
            <p>Ya has completado tu inscripción correctamente.</p>
        @else
            <p class="m-0">Aquí podrás inscribir tu perfil para convertirte en productor/a:</p>
            <form action="{{ route('slates.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">

                @csrf
                
                <div class="row">
                    <h4 class="mt-5 mb-3">Datos de Producción</h4>
                    <div class="col">

                        <x-ecam.input type="text" name="productor" label="Nombre y apellidos del productor/a" required />
                        <small class="d-block mb-4">*En caso de haber varios productores/as, ésta será la persona que asistirá a las sesiones de La Incubadora, la receptora de la ayuda, así como el interlocutor/a del proyecto.</small>
                            
                        <x-ecam.input type="date" name="fecha_nac_productor" label="Fecha de nacimiento" required /> 
                            
                        <p class="mt-4 mb-1 required required-tag">Sexo (por motivos estadísticos)</p>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="sexo_productor" id="sexoM" value="masculino">
                            <label class="form-check-label" for="sexoM">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="sexo_productor" id="sexoF" value="femenino">
                            <label class="form-check-label" for="sexoF">
                                Femenino
                            </label>
                        </div>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="sexo_productor" id="sexoO" value="otro">
                            <label class="form-check-label" for="sexoO">
                                Otro
                            </label>
                        </div>
                        <x-ecam.error name="sexo" />

                        <x-ecam.input type="text" name="productora" label="Compañía productora" class="mt-4"/>

                        <x-ecam.input type="tel" name="tel_productor" label="Teléfono" required />

                        <x-ecam.input type="text" name="cod_postal_productor" label="Código Postal" required />

                        <x-ecam.input type="text" name="ciudad_productor" label="Ciudad" required />

                        <x-ecam.select-paises name="pais_productor" label="País" required />

                        <x-ecam.input type="email" name="email_productor" label="Email" required />

                        <x-ecam.input type="url" name="web_productor" label="Web" />                
                    </div>

                    <div class="col">
                        <h5 class="required required-tag w-auto">Documentación</h5>
                        <label for="pdf_documentacion" class="form-label mb-3">
                            Adjunta un único documento en PDF con un máximo de 10 páginas y 20MB que incluya los siguientes documentos:
                            <ul>
                                <li>Biofilmografía.</li>
                                <li>Carta de motivación.</li>
                                <li>Descripción de la empresa (o la actividad profesional, en caso de que no hubiera empresa).</li>
                                <li>Breve descripción del slate de proyectos de la compañía.</li>
                                <li>En caso de ser empleado de otra empresa, breve descripción del rol y la responsabilidad dentro de la compañía y de los proyectos liderados.</li>
                            </ul>
                        </label>
                        <input class="form-control d-inline me-3" type="file" id="pdf_documentacion" name="pdf_documentacion" accept=".pdf">
                        <x-ecam.error name="pdf_documentacion" />
                        
                        {{-- AQUI PARA EDITAR _ ADMIN --}}

                        {{-- @if( $guion = $inscripcion->archivos()->where('archivo_tipo_id', 2)->first() )
                            @php                        
                                $guionUrl = Storage::url($guion->url);                
                            @endphp
                            <a href="{{ $guionUrl }}" target="_blank">
                                <i class="fa-regular fa-fw fa-file-pdf"></i>
                                Ver PDF Guion
                            </a>
                        @endif --}}
                    </div>
                </div>

                <div class="mt-5 float-end">
                    <button class="btn btn-rojo" type="submit">Enviar</button>
                </div>
            </form>
            
        @endif

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