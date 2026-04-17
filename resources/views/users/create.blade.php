@extends('adminlte::page')

@section('title', 'Nuevo usuario')

@section('content')

    <h1>Nuevo usuario</h1>

    <form action="{{ route('users.store') }}" method="POST" autocomplete="off">

        @csrf

        <x-ecam.input type="text" name="name" label="Nombre"/>
        <x-ecam.input type="email" name="email" label="Email"/>
        <x-ecam.input type="password" name="password" label="Contraseña"/>
        
        <select name="rol" class="form-select {{ $errors->has('rol') ? 'is-invalid' : '' }}">
            <option value="">- Selecciona un rol -</option>
            @foreach ($roles as $rol) 
                <option value="{{ $rol->name }}" {{ old('rol') == $rol->name ? 'selected' : '' }}>{{ $rol->name }}</option>
            @endforeach
        </select>
        <x-ecam.error name='rol' />

        <button class="btn btn-rojo" type="submit">Crear usuario</button>
    </form>

@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop