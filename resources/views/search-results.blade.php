@extends('adminlte::page')

@section('title', 'Inscripciones')

@section('content')
    <main class="container ms-0 me-auto">
        <h1 class="mt-5 mb-5 pt-3">Resultados de búsqueda para: <strong>{{ $term }}</strong></h1>
        <div class="row g-4">
            @foreach ( $results as $result )
                <div class="col col-md-4">
                    <div class="card h-100">
                        <div class="image-wrapper">
                            @php
                                $imageUrl = Storage::url('/images/portada_default.jpg');
                                if( $portada = $result->archivos()->where('archivo_tipo_id', 1)->first() )
                                    $imageUrl = Storage::url($portada->url);
                            @endphp
                            <div class="ico-categoria cat-{{ Str::lower(Str::replace(' ', '-', ($result->categoria->name))) }}"></div>
                            <img src="{{ $imageUrl }}" class="portada" alt="Portada">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title float-none">{{ $result->titulo }}</h3>
                            <p class="card-title float-none mb-4">{{ $result->user->name }}</p>
                            <a class="btn btn-filter" href="/admin/inscripcion/{{ $result->id }}">Ver inscripción</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('js')
@stop
