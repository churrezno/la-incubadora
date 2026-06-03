@extends('adminlte::page')

@section('title', 'Slates')

@section('plugins.Datatables', true)
@section('plugins.NaturalSorting', true)
@section('plugins.Sweetalert2', true)

@section('content')

    <x-ecam.buttons-filter-slates />

    <x-adminlte-datatable id="tableSlates" :heads="$heads" :config="$config">
    </x-adminlte-datatable>

@stop

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script>

        function format(d) {
            // `d` is the original data object for the row
            return '<div class="slider">' + 
                        d.valoraciones +
                    '</div>';
        }

        function updateAsignacionesSlate(event) {
            event.preventDefault();
            let table = $('#tableSlates').DataTable( {
                            retrieve: true,
                        }),
                id = event.target.id,
                form = document.getElementById('form_' + id),
                formData = new FormData(form),
                _token = formData.get('_token');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $.ajax({
                url: '/admin/asignaciones',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(){
                    console.log("Updated!");
                    table.ajax.reload(null, false);
                    Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Asignaciones actualizadas :)",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                },
                error: function (data) {
                    Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Algo salió mal :(",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000
                        });
                }
            });
        }

        function updateCategoriaSlate(event, slateId) {
            event.preventDefault();
            let table = $('#tableSlates').DataTable( {
                            retrieve: true,
                        }),
                id = event.target.id,
                form = document.getElementById('form_' + id),
                formData = new FormData(form),
                _token = formData.get('_token');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $.ajax({
                url: '/admin/slates/update-category/' + slateId,
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(){
                    console.log("Updated!");
                    table.ajax.reload(null, false);
                    Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Categoría actualizada :)",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                },
                error: function (data) {
                    Swal.fire({
                            toast: true,
                            position: "top-end",
                            title: "Algo salió mal :(",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    // console.log(data);
                }
            });
        }

        function removeSlate(id) {

            Swal.fire({
                title: "¿Seguro que quieres eliminar la slate con id = " + id + "?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                iconColor: '#FFC700',
                showCancelButton: true,
                confirmButtonColor: "#a4dd78",
                cancelButtonColor: "#FC1048",
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {

                    var _token = document.getElementsByName("_token")[0].value
                    let table = $('#tableSlates').DataTable( {
                                    retrieve: true,
                                });
                    
                    $.ajax({
                        url: '/admin/slates/' + id,
                        type: 'POST',
                        data: {
                            _token: _token,
                            _method: 'delete'
                        },
                        success: function(){
                            console.log("Removed id:" + id);
                            table.ajax.reload(null, false);
                            Swal.fire({
                                    title: "Eliminada!",
                                    text: "Slate eliminada.",
                                    icon: "success",
                                    showConfirmButton: false,
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

            DataTable.datetime('D/M/Y');

            // Add event listener for opening and closing details
            let table = $('#tableSlates').DataTable();

            table.on('click', '.btn-valoraciones', function (e) {
                let tr = e.target.closest('tr');
                let row = table.row(tr);
            
                if (row.child.isShown()) {
                    $('div.slider', row.child()).slideUp( function () {
                        row.child.hide();
                    } );
                }
                else {
                    row.child( format(row.data()), 'no-padding' ).show();     
                    $('div.slider', row.child()).slideDown();
                }
            });

            //Create filter buttons for categories
            function filterIncludeExcludeMulti(includeStr, excludeList) {
                // Escape user input for regex safety
                function escapeRegex(str) {
                    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                }

                const include = escapeRegex(includeStr);
                const excludes = excludeList.map(escapeRegex);

                // Start building the regex
                let regex = `^(?=.*${include})`;

                // Add negative lookaheads for each exclude string
                excludes.forEach(str => {
                    regex += `(?!.*${str})`;
                });

                // Complete the regex
                regex += `.*`;

                // Apply to column 0, with regex enabled
                table.column(0).search(regex, true, false).draw();
            }

            $('button#todas').on('click', function () {
                table.column(0).search('').draw();
            });

            $('button#descartada').on('click', function () {
                filterIncludeExcludeMulti('cat-descartada', []);
            });

            $('button#preseleccionada').on('click', function () {
                filterIncludeExcludeMulti('cat-preseleccionada', []);
            });

            $('button#seleccionada').on('click', function () {
                filterIncludeExcludeMulti('cat-seleccionada', []);
            });
        });
    </script>
@stop
