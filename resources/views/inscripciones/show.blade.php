@extends('adminlte::page')

@section('title', Str::ucfirst($inscripcion->titulo))

@section('plugins.Datatables', true)
{{-- @section('plugins.DatatablesPlugins', true) --}}

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>        
    @endif

<div class="container ms-0 pt-3">
    @role('admin')
        <div class="clearfix">
            <a href="{{ route('inscripciones.create.step.one', $inscripcion->id) }}" class="btn btn-filter mt-3 mb-3 float-right">Editar inscripción</a>
        </div>
    @endrole

    {{-- <p><strong>Categoría:</strong> {{ $inscripcion->categoria->name ?? '' }}</p> --}}

    <div class="row align-items-start">
        <div class="col">
            @if ( !$inscripcion->complete )
                <div class="txt-rojo mb-n1 fw-medium">
                    <i class="fa-solid fa-fw fa-exclamation-triangle"></i>
                    INCOMPLETA
                </div>
            @endif
            <h1 class="mb-3">{{ Str::ucfirst($inscripcion->titulo) }}</h1>
            <p class="data_title">Autor</p>
            <p class="data_text">{{ $inscripcion->user->name }}</p>
        </div>
        <div class="col">
            <div class="image-wrapper">
                @php
                    $imageUrl = Storage::url('/images/portada_default.jpg');
                    if( $portada = $inscripcion->archivos()->where('archivo_tipo_id', 1)->first() )
                        $imageUrl = Storage::url($portada->url);
                @endphp
                <img src="{{ $imageUrl }}" class="portada" alt="Portada">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Datos de Dirección</h3>
            <p class="data_title">Nombre completo</p>
            <p class="data_text">{{ $inscripcion->director }}</p>

            <p class="data_title">Fecha de nacimiento</p>
            <p class="data_text">{{ date('d/m/Y', strtotime($inscripcion->fecha_nac_director)) }}</p>

            <p class="data_title">Sexo</p>
            <p class="data_text">{{ $inscripcion->sexo_director }}</p>

            <p class="data_title">¿Primer largo?</p>
            <p class="data_text">{{ ($inscripcion->switch_largometrajes) ? 'Sí' : 'No' }}</p>
                   
            @if ($inscripcion->largometrajes)
                <p class="data_title">Otros largos</p>
                <p class="data_text">{{ $inscripcion->largometrajes }}</p>
            @endif

            <p class="data_title">¿Existe codirector/a?</p>
            <p class="data_text">{{ ($inscripcion->switch_codirector) ? 'Sí' : 'No' }}</p>
                   
            @if ($inscripcion->codirector)
                <p class="data_title">Codirección</p>
                <p class="data_text">{{ $inscripcion->codirector }}</p>
            @endif
        </div>

        <div class="col">
            <h3 class="mt-5 mb-3">Datos de Guion</h3>
            <p class="data_title">¿El director/a es el guionista?</p>
            <p class="data_text">{{ ($inscripcion->switch_guionista) ? 'Sí' : 'No' }}</p>
                   
            @if ($inscripcion->guionista)
                <p class="data_title">Guionista</p>
                <p class="data_text">{{ $inscripcion->guionista }}</p>
            @endif

            <p class="data_title">¿Existe coguionista?</p>
            <p class="data_text">{{ ($inscripcion->switch_coguionista) ? 'Sí' : 'No' }}</p>
                   
            @if ($inscripcion->coguionista)
                <p class="data_title">Coguionista</p>
                <p class="data_text">{{ $inscripcion->coguionista }}</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Datos de Producción</h3>
            <p class="data_title">Compañía productora</p>
            <p class="data_text">{{ $inscripcion->productora }}</p>

            <p class="data_title">Teléfono</p>
            <p class="data_text"><a href="tel:{{ $inscripcion->tel_productor }}">{{ $inscripcion->tel_productor }}</a></p>

            <p class="data_title">Código Postal</p>
            <p class="data_text">{{ $inscripcion->cod_postal_productor }}</p>

            <p class="data_title">Ciudad</p>
            <p class="data_text">{{ $inscripcion->ciudad_productor }}</p>

            <p class="data_title">País</p>
            <p class="data_text">{{ $inscripcion->pais_productor }}</p>

            <p class="data_title">Email</p>
            <p class="data_text"><a href="mailto:{{ $inscripcion->email_productor }}">{{ $inscripcion->email_productor }}</a></p>

            <p class="data_title">Web</p>
            <p class="data_text"><a href="{{ $inscripcion->web_productor }}" target="_blank">{{ $inscripcion->web_productor }}</a></p>

            <p class="data_title">Productor</p>
            <p class="data_text">{{ $inscripcion->productor }}</p>

            <p class="data_title">Fecha de nacimiento</p>
            <p class="data_text">{{ date('d/m/Y', strtotime($inscripcion->fecha_nac_productor)) }}</p>
        </div>

        <div class="col">
            <h3 class="mt-5 mb-3">Datos de Coproducción</h3>
            <p class="data_title">¿Existe coproductor?</p>
            <p class="data_text">{{ ($inscripcion->switch_coproductor) ? 'Sí' : 'No' }}</p>
                   
            @if ($inscripcion->coproductor)
                <p class="data_title">Coproductor</p>
                <p class="data_text">{{ $inscripcion->coproductor }}</p>
            @endif  

            <p class="data_title">¿El proyecto sería una coproducción internacional?</p>
            <p class="data_text">{{ ($inscripcion->switch_paises_coproduccion) ? 'Sí' : 'No' }}</p>
                   
            @if ($inscripcion->paises_coproduccion)
                <p class="data_title">Países de coproducción</p>
                <p class="data_text">{{ $inscripcion->paises_coproduccion }}</p>
            @endif            
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Datos del Equipo</h3>
            <p class="data_title">Biofilmografía del director/a</p>
            <div class="data_text mb-4">{!! $inscripcion->biofilmografia_director !!}</div>
                   
            @if ( $inscripcion->titulo_1 || $inscripcion->titulo_2 || $inscripcion->titulo_3)
                <p class="data_title">Trabajo previo del director/a</p>
            @endif  
                   
            @if ($inscripcion->titulo_1)
                <p class="data_text mb-0">Título: <span class="text-uppercase fw-medium">{{ $inscripcion->titulo_1 }}</span></p>
                <p class="data_text mb-0">Link: <a href="{{ $inscripcion->link_1 }}" target="_blank">{{ $inscripcion->link_1 }}</a></p>
                <p class="data_text mb-4">Contraseña: {{ $inscripcion->password_1 }}</p>
            @endif  
                   
            @if ($inscripcion->titulo_2)
                <p class="data_text mb-0 mt-n3">Título: <span class="text-uppercase fw-medium">{{ $inscripcion->titulo_2 }}</span></p>
                <p class="data_text mb-0">Link: <a href="{{ $inscripcion->link_2 }}" target="_blank">{{ $inscripcion->link_2 }}</a></p>
                <p class="data_text mb-4">Contraseña: {{ $inscripcion->password_2 }}</p>
            @endif  
                   
            @if ($inscripcion->titulo_3)
                <p class="data_text mb-0 mt-n3">Título: <span class="text-uppercase fw-medium">{{ $inscripcion->titulo_3 }}</span></p>
                <p class="data_text mb-0">Link: <a href="{{ $inscripcion->link_3 }}" target="_blank">{{ $inscripcion->link_3 }}</a></p>
                <p class="data_text mb-4">Contraseña: {{ $inscripcion->password_3 }}</p>
            @endif  

            <p class="data_title">Nota del director/a</p>
            <div class="data_text mb-4">{!! $inscripcion->nota_director !!}</div>

            <p class="data_title">Biofilmografía de la productora</p>
            <div class="data_text mb-4">{!! $inscripcion->biofilmografia_productora !!}</div>

            <p class="data_title">Nota del productor/a</p>
            <div class="data_text mb-4">{!! $inscripcion->nota_productor !!}</div>

            <p class="data_title">Biofilmografía del guionista</p>
            <div class="data_text mb-4">{!! $inscripcion->biofilmografia_guionista !!}</div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Ficha técnica</h3>
            <p class="data_title">Idioma</p>
            <div class="data_text mb-4">{{ $inscripcion->idioma }}</div>

            <p class="data_title">Duración</p>
            <div class="data_text mb-4">{{ $inscripcion->duracion }}</div>

            <p class="data_title">Género</p>
            <div class="data_text mb-4">{{ $inscripcion->genero }}</div>

            <p class="data_title">Logline</p>
            <div class="data_text mb-4">{!! $inscripcion->logline !!}</div>

            <p class="data_title">Sinopsis</p>
            <div class="data_text mb-4">{!! $inscripcion->sinopsis !!}</div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Financiación</h3>
            <p class="data_title">Presupuesto</p>
            <div class="data_text mb-4">{{ $inscripcion->presupuesto }}</div>

            <p class="data_title">Plan de financiación</p>
            <div class="data_text mb-4">{!! $inscripcion->plan_financiacion !!}</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Promoción</h3>    
            <p class="data_title">Plan de promoción y difusión</p>
            <div class="data_text mb-4">{!! $inscripcion->plan_promocion !!}</div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Status</h3>
            <p class="data_title">¿El proyecto ha participado en otros programas de formación y mentoría, labs, foros...?</p>
            <p class="data_text">{{ ($inscripcion->switch_otros_programas) ? 'Sí' : 'No' }}</p>

            @if ($inscripcion->otros_programas)                
                <p class="data_title">Otros programas</p>
                <div class="data_text mb-4">{!! $inscripcion->otros_programas !!}</div>
            @endif
            
            <p class="data_title">Otras participaciones en La Incubadora</p>
            <p class="data_text">{{ ($inscripcion->switch_otras_incubadora) ? 'Sí' : 'No' }}</p>

            <p class="data_title">Estado</p>
            <div class="data_text mb-4">{!! $inscripcion->status !!}</div>

            <p class="data_title">Otros proyectos</p>
            <div class="data_text mb-4">{!! $inscripcion->otros_proyectos !!}</div>

            <p class="data_title">Motivaciones y objetivos</p>
            <div class="data_text mb-4">{!! $inscripcion->motivaciones !!}</div>

            <p class="data_title">¿Cómo nos has conocido?</p>
            <div class="data_text mb-4">{!! $inscripcion->conocido !!}</div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <h3 class="mt-5 mb-3">Documentación</h3>
            <p class="data_title">Guion</p>
                @if( $guion = $inscripcion->archivos()->where('archivo_tipo_id', 2)->first() )
                    @php                        
                        $guionUrl = Storage::url($guion->url);                
                    @endphp
                    <p class="data_text"><a href="{{ $guionUrl }}" target="_blank">
                        <i class="fa-regular fa-fw fa-file-pdf"></i>
                        Ver PDF</a>
                    </p>
                @endif

                @if( $infoExtra = $inscripcion->archivos()->where('archivo_tipo_id', 3)->first() )
                    <p class="data_title">Información adicional</p>
                    @php                        
                        $infoExtraUrl = Storage::url($infoExtra->url);                
                    @endphp
                    <p class="data_text"><a href="{{ $infoExtraUrl }}" target="_blank">
                        <i class="fa-regular fa-fw fa-file-pdf"></i>
                        Ver PDF</a>
                    </p>
                @endif
        </div>
    </div>

    

    @role('admin')
        <x-adminlte-datatable id="tableValoraciones" :heads="$heads" :config="$config">
        </x-adminlte-datatable>

        {{-- Navegación --}}
        <div class="wrapper-links mt-5 mb-5">
            <div class="row p-0">
                <div class="col-6">
                    @if (isset($prev))
                        <a class="text-link" href="{{ route('inscripciones.show', $prev->id) }}">
                            <i class="fa-solid fa-fw fa-arrow-left"></i>
                            {{ $prev->titulo }}
                        </a>
                        @endif
                    </div>
                    <div class="col-6 text-right">
                        @if (isset($next))
                        <a class="text-link" href="{{ route('inscripciones.show', $next->id) }}">
                            {{ $next->titulo }}
                            <i class="fa-solid fa-fw fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endrole

    @role('comite')
        @php
            $userID = Auth::user()->id;
            $asignacionID = $inscripcion->asignaciones->where('user_id', $userID)->first()->id;
            $valoracion = $inscripcion->valoraciones->where('asignacion_id', $asignacionID)->first();
        @endphp

        <x-ecam.form-valoracion asignacionID="{{ $asignacionID }}" :valoracion="$valoracion" />
    @endrole
    
</div>

@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('js')    
    <script>
        $(document).ready(function() {

            function updatePuntuacionTotal() {

                let totalPuntosBruto = 0;
                let selects = $('.select-puntos');

                for(var i = 0; i < selects.length; i++){
                    if ( parseFloat(selects[i].value) >= 0 )
                        totalPuntosBruto += parseFloat(selects[i].value);
                    else return false;
                }   
                let totalPuntosSinRedondeo = (totalPuntosBruto / 3).toFixed(1);
                $('#puntos_total').val((totalPuntosSinRedondeo * 10 % 10 == 0) ? Math.floor(totalPuntosSinRedondeo) : totalPuntosSinRedondeo);
            }

            $('.select-puntos').on('change', function () {
                updatePuntuacionTotal();
            });
        });
    </script>
@stop
