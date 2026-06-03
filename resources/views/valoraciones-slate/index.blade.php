@extends('adminlte::page')

@section('title', 'Valoraciones Slate')

@section('plugins.Datatables', true)
@section('plugins.NaturalSorting', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <x-adminlte-datatable id="tableValoracionesSlate" :heads="$heads" :config="$config">
    </x-adminlte-datatable>

@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script>
        $(document).ready(function() {            
            //Format date to allow correct orderby in 'Fecha' column
            DataTable.datetime('D/M/Y');
            let table = $('#tableValoracionesSlate').DataTable();
        });
    </script>
@stop