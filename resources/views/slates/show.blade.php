@extends('adminlte::page')

@section('title', Str::ucfirst($slate->titulo))

@section('plugins.Datatables', true)

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>        
    @endif

<div class="container ms-0 pt-3">
    @role('admin')
        {{-- <div class="clearfix">
            <a href="{{ route('inscripciones.create.step.one', $slate->id) }}" class="btn btn-filter mt-3 mb-3 float-right">Editar inscripción</a>
        </div> --}}
    @endrole


    <div class="row align-items-start">
        <div class="col">
            <h1 class="mb-3">{{ Str::ucfirst($slate->productor) }}</h1>
            <p class="data_title">Autor</p>
            <p class="data_text">{{ $slate->user->name }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3 class="mt-5 mb-3">Datos de Producción</h3>

            <p class="data_title">Productor</p>
            <p class="data_text">{{ $slate->productor }}</p>

            <p class="data_title">Fecha de nacimiento</p>
            <p class="data_text">{{ date('d/m/Y', strtotime($slate->fecha_nac_productor)) }}</p>

            <p class="data_title">Compañía productora</p>
            <p class="data_text">{{ $slate->productora }}</p>

            <p class="data_title">Teléfono</p>
            <p class="data_text"><a href="tel:{{ $slate->tel_productor }}">{{ $slate->tel_productor }}</a></p>

            <p class="data_title">Código Postal</p>
            <p class="data_text">{{ $slate->cod_postal_productor }}</p>

            <p class="data_title">Ciudad</p>
            <p class="data_text">{{ $slate->ciudad_productor }}</p>

            <p class="data_title">País</p>
            <p class="data_text">{{ $slate->pais_productor }}</p>

            <p class="data_title">Email</p>
            <p class="data_text"><a href="mailto:{{ $slate->email_productor }}">{{ $slate->email_productor }}</a></p>

            <p class="data_title">Web</p>
            <p class="data_text"><a href="{{ $slate->web_productor }}" target="_blank">{{ $slate->web_productor }}</a></p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <h3 class="mt-5 mb-3">Documentación</h3>
            <p class="data_title">Documentación Productor/a</p>
                @if( $documentacion = $slate->archivo()->where('archivo_tipo_id', 4)->first() )
                    @php                        
                        $documentacionUrl = Storage::url($documentacion->url);                
                    @endphp
                    <p class="data_text"><a href="{{ $documentacionUrl }}" target="_blank">
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
            $asignacion = $slate->asignaciones->where('user_id', $userID)->first();
        @endphp

        @if($asignacion)
            @php
                $valoracion = $slate->valoracionesSlate->where('asignacion_id', $asignacion->id)->first();
            @endphp
            <x-ecam.form-valoracion-slate asignacionID="{{ $asignacion->id }}" :valoracion="$valoracion ?? null" />
        @endif
    @endrole
    
</div>

@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop
