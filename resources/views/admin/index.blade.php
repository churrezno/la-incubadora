
{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Admin')

{{-- @section('plugins.Datatables', true) --}}

@section('content_header')
    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
@stop

@section('content')
    
@stop

@section('css')
    <x-assets />
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop