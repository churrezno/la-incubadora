@extends('adminlte::page')

@section('title', 'Usuarios')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <a href="{{ route('users.create') }}" class="btn btn-filter mt-3 mb-3 float-right">Crear usuario</a>

    <x-adminlte-datatable id="tableUsers" :heads="$heads" :config="$config">
    </x-adminlte-datatable>

@stop

@section('css')
    <x-assets />
@stop

@section('js')
    <script>
        function removeUser(id) {

            Swal.fire({
                title: "¿Seguro que quieres eliminar el usuario con id = " + id + "?",
                text: "Esta acción no se puede dehacer",
                icon: "warning",
                iconColor: '#FFC700',
                showCancelButton: true,
                confirmButtonColor: "#a4dd78",
                cancelButtonColor: "#FC1048",
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {

                    var _token = document.getElementsByName("_token")[0].value
                    let table = $('#tableUsers').DataTable( {
                                    retrieve: true,
                                });
                    
                    $.ajax({
                        url: '/admin/users/' + id,
                        type: 'POST',
                        data: {
                            _token: _token,
                            _method: 'delete'
                        },
                        success: function(){
                            console.log("Removed id:" + id);
                            table.ajax.reload(null, false);
                            Swal.fire({
                                    title: "Eliminado!",
                                    text: "Usuario eliminado.",
                                    showConfirmButton: false,
                                    icon: "success",
                                    timer: 1500
                                });
                        },
                        error: function (data) {
                            Swal.fire({
                                    title: "Error!",
                                    text: "Algo salió mal.",
                                    showConfirmButton: false,
                                    icon: "error",
                                    timer: 1500
                                });
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
        });
    </script>
@stop