@extends('adminlte::page')

@section('title', 'Nueva inscripción')

@section('content')

    <h1>Nueva inscripción</h1>

    <p>Nº inscripciones ya hechas: {{ $numInscripcionesUser }}</p>

    @if ($numInscripcionesUser < 2)        
        <form action="{{ route('inscripciones.store') }}" method="POST" autocomplete="off">

            @csrf

            <x-ecam.input type="text" name="titulo" label="Título"/>

            <select name="categoria_id" class="form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }}">
                <option value="">- Selecciona una categoria -</option>
                @foreach ($categorias as $categoria) 
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
                @endforeach
            </select>
            <x-ecam.error name='categoria_id' />

            <button class="btn btn-rojo" type="submit">Crear inscripción</button>
        </form>
    @else
        <strong>Has alcanzado el número máximo de inscripciones</strong>
        <p>Puedes verlas <a href="#">aquí</a></p>
    @endif

@stop

@section('css')
    <x-assets />
@stop