@extends('adminlte::page')

@section('title', 'Editar USUARIO')

@section('content')

    <h1>Editar usuario</h1>

    <form action="{{ route('users.update', $user) }}" method="POST">

        @csrf
        @method('PUT')

        <x-ecam.input type="text" name="name" label="Nombre" old_data="{{ $user->name }}"/>
        <x-ecam.input type="email" name="email" label="Email" old_data="{{ $user->email }}"/>
        <x-ecam.input type="password" name="password" label="Contraseña" old_data="{{ $user->password }}"/>

        <select name="rol" class="form-select {{ $errors->has('rol') ? 'is-invalid' : '' }}">
            <option value="">- Selecciona un rol -</option>
            @foreach ($roles as $rol) 
                <option value="{{ $rol->name }}" {{ $user->hasRole($rol->name) ? 'selected' : '' }}>{{ $rol->name }}</option>
            @endforeach
        </select>
        <x-ecam.error name='rol' />

        <button class="btn btn-rojo" type="submit">Actualizar usuario</button>
    </form>

@stop

@section('css')
    <x-assets />
@stop
