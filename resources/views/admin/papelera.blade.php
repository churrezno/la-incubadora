@extends('adminlte::page')

@section('title', 'Papelera de reciclaje')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <div class="container ms-0">

        <h1 class="mt-5 mb-4 pt-3">Elementos eliminados</h1>

        <h3 class="mb-2">
            <i class="fa-solid me-2 fa-user "></i>
            Usuarios
        </h3>
        <x-adminlte-datatable id="tableUsersTrash" :heads="$headsUsers" :config="$configUsers">
        </x-adminlte-datatable>
        
        <h3 class="mt-5 mb-2">
            <i class="fa-solid me-2 fa-video "></i>
            Inscripciones
        </h3>
        <x-adminlte-datatable id="tableInscripcionesTrash" :heads="$headsInscripciones" :config="$configInscripciones">
        </x-adminlte-datatable>
    </div>

@stop


@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('js')
    <script>
        function restoreUser(id) {
            let table = $('#tableUsersTrash').DataTable( {
                                    retrieve: true,
                                });
            $.ajax({
                    url: '/admin/papelera/user/' + id,
                    type: 'GET',
                    success: function(){
                        console.log('OK!');
                        table.ajax.reload(null, false);
                        Swal.fire({
                                toast: true,
                                title: "Usuario restaurado!",
                                position: "top-end",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 2000
                            });
                    },
                    error: function (data) {
                        Swal.fire({
                                title: "Error!",
                                text: "Algo salió mal.",
                                position: "top-end",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 2000
                            });
                    }
                });
        }

        function restoreInscripcion(id) {
            let table = $('#tableInscripcionesTrash').DataTable( {
                                    retrieve: true,
                                });
            $.ajax({
                    url: '/admin/papelera/inscripcion/' + id,
                    type: 'GET',
                    success: function(){
                        console.log('OK!');
                        table.ajax.reload(null, false);
                        Swal.fire({
                                toast: true,
                                title: "Inscripción restaurada!",
                                position: "top-end",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 2000
                            });
                    },
                    error: function (data) {
                        Swal.fire({
                                title: "Error!",
                                text: "Algo salió mal.",
                                position: "top-end",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 2000
                            });
                    }
                });
        }

        function forceRemoveUser(id) {
            Swal.fire({
                title: "¿Eliminar DEFINITIVAMENTE al usuario con id = " + id + "?",
                text: "Esta acción eliminará permanentemente al usuario de la base de datos.",
                icon: "warning",
                iconColor: '#FC1048',
                showCancelButton: true,
                confirmButtonColor: "#a4dd78",
                cancelButtonColor: "#FC1048",
                confirmButtonText: "Eliminar permanentemente"
            }).then((result) => {
                if (result.isConfirmed) {
                    var _token = document.getElementsByName("_token")[0].value;
                    let tableUsersTrash = $('#tableUsersTrash').DataTable({ retrieve: true });
                    let tableInscripcionesTrash = $('#tableInscripcionesTrash').DataTable({ retrieve: true });
                    
                    $.ajax({
                        url: '/admin/users/' + id + '/force',
                        type: 'POST',
                        data: {
                            _token: _token,
                            _method: 'delete'
                        },
                        success: function () {
                            console.log("Force removed id:" + id);
                            tableUsersTrash.ajax.reload(null, false);
                            tableInscripcionesTrash.ajax.reload(null, false);
                            Swal.fire({
                                title: "Eliminado!",
                                text: "Usuario eliminado permanentemente.",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 1500
                            });
                        },
                        error: function (data) {
                            Swal.fire({
                                title: "Error!",
                                text: "No se pudo eliminar permanentemente.",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 1500
                            });
                        }
                    });
                }
            });
        }


        function forceRemoveInscripcion(id) {
            Swal.fire({
                title: "¿Eliminar DEFINITIVAMENTE la inscripción con id = " + id + "?",
                text: "Esta acción eliminará permanentemente la inscripción de la base de datos.",
                icon: "warning",
                iconColor: '#FC1048',
                showCancelButton: true,
                confirmButtonColor: "#a4dd78",
                cancelButtonColor: "#FC1048",
                confirmButtonText: "Eliminar permanentemente"
            }).then((result) => {
                if (result.isConfirmed) {
                    var _token = document.getElementsByName("_token")[0].value;
                    let tableUsersTrash = $('#tableUsersTrash').DataTable({ retrieve: true });
                    let tableInscripcionesTrash = $('#tableInscripcionesTrash').DataTable({ retrieve: true });
                    
                    $.ajax({
                        url: '/admin/inscripciones/' + id + '/force',
                        type: 'POST',
                        data: {
                            _token: _token,
                            _method: 'delete'
                        },
                        success: function () {
                            console.log("Force removed id:" + id);
                            tableUsersTrash.ajax.reload(null, false);
                            tableInscripcionesTrash.ajax.reload(null, false);
                            Swal.fire({
                                title: "Eliminado!",
                                text: "Inscripción eliminada permanentemente.",
                                showConfirmButton: false,
                                icon: "success",
                                timer: 1500
                            });
                        },
                        error: function (data) {
                            Swal.fire({
                                title: "Error!",
                                text: "No se pudo eliminar permanentemente.",
                                showConfirmButton: false,
                                icon: "error",
                                timer: 1500
                            });
                        }
                    });
                }
            });
        }

    </script>
@stop