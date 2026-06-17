@extends('adminlte::page')

@section('title', 'Editar inscripción')

@section('content')

    <h1>Editar inscripción</h1>

    <form action="{{ route('inscripciones.update', $inscripcion) }}" method="POST">

        @csrf
        @method('PUT')

        {{ $inscripcion->categoria->name }}

        <p class="mt-3"><strong>Autor:</strong> {{ $inscripcion->user->name }}</p>
        <x-ecam.input type="text" name="titulo" label="Título" old_data="{{ $inscripcion->titulo }}"/>

        <select name="categoria_id" class="form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }}">
            <option value="">- Selecciona una categoría -</option>
            @foreach ($categorias as $categoria) 
                <option value="{{ $categoria->id }}" {{ ( $categoria->name == $inscripcion->categoria->name ) ? 'selected' : '' }}>{{ $categoria->name }}</option>
            @endforeach
        </select>
        <x-ecam.error name='categoria_id' />

        @foreach ($inscripcion->archivos as $archivo)
            <img src="{{ Storage::url($archivo->url) }}" alt="" />
            <p><strong>Tipo de archivo:</strong> {{ $archivo->archivo_tipo->name }}</p>
        @endforeach

        <button class="btn btn-rojo" type="submit">Actualizar inscripcion</button>
    </form>

@stop

@section('css')
    <x-assets />
@stop