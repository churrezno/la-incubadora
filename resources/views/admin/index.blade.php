
{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Admin')

{{-- @section('plugins.Datatables', true) --}}

@section('content_header')
    <h1>Bienvenido</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop