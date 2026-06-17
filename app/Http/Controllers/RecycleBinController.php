<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inscripcion;
use App\Models\Slate;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    public function index() {

        $headsUsers = [
            // 'DT_RowId',
            'ID',
            'Nombre',
            'Acción'
        ];

        $configUsers = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json')
            ],
            'ajax' => [
                'url' => route('datatable.users.trash')
            ],
            'columns' => [
                ['data' => 'id', 'width' => '80px'],
                ['data' => 'name'],
                ['data' => 'acciones', 'width' => '80px', 'sortable' => false, 'width' => '120px'],
            ],
            'pageLength' => 10,
            'lengthMenu' => [[ 10, 25, 50, 75, 100, -1 ],[ 10, 25, 50, 75, 100, "Todos" ]],
            'buttons' => [
                ['pageLength'],
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF'],
            ],
            'order' =>  [
                [0, 'asc']
            ],
            'layout' => [
                'topStart' => 'buttons'
            ] 
        ];


        $headsInscripciones = [
            // 'DT_RowId',
            'ID',
            'Nombre',
            'Acción'
        ];

        $configInscripciones = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json')
            ],
            'ajax' => [
                'url' => route('datatable.inscripciones.trash')
            ],
            'columns' => [
                ['data' => 'id', 'width' => '80px'],
                ['data' => 'titulo'],
                ['data' => 'acciones', 'width' => '80px', 'sortable' => false, 'width' => '120px'],
            ],
            'pageLength' => 10,
            'lengthMenu' => [[ 10, 25, 50, 75, 100, -1 ],[ 10, 25, 50, 75, 100, "Todos" ]],
            'buttons' => [
                ['pageLength'],
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF'],
            ],
            'order' =>  [
                [0, 'asc']
            ],
            'layout' => [
                'topStart' => 'buttons'
            ] 
        ];


        $headsSlates = [
            // 'DT_RowId',
            'ID',
            'Nombre',
            'Acción'
        ];

        $configSlates = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json')
            ],
            'ajax' => [
                'url' => route('datatable.slates.trash')
            ],
            'columns' => [
                ['data' => 'id', 'width' => '80px'],
                ['data' => 'productor'],
                ['data' => 'acciones', 'width' => '80px', 'sortable' => false, 'width' => '120px'],
            ],
            'pageLength' => 10,
            'lengthMenu' => [[ 10, 25, 50, 75, 100, -1 ],[ 10, 25, 50, 75, 100, "Todos" ]],
            'buttons' => [
                ['pageLength'],
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF'],
            ],
            'order' =>  [
                [0, 'asc']
            ],
            'layout' => [
                'topStart' => 'buttons'
            ] 
        ];

        return view('admin.papelera', compact('headsUsers', 'configUsers', 'headsInscripciones', 'configInscripciones', 'headsSlates', 'configSlates'));
    }


    public function restoreUser($id) {

        $user = User::withTrashed()->find($id);
        $user->restore();

        $this->restoreAsignacionesUser($user);
        $this->restoreValoracionesUser($user);
        $this->restoreInscripcionesUser($user);
        $this->restoreSlateUser($user);

        return redirect()->back()->with('info', 'Usuario recuperado :)');
    }


    public function restoreInscripcion($id) {
                  
        $inscripcion = Inscripcion::withTrashed()->find($id);
        $inscripcion->restore();

        $this->restoreAsignacionesInscripcion($inscripcion); 
        $this->restoreValoracionesInscripcion($inscripcion);       

       return redirect()->back()->with('info', 'Inscripción recuperada :)');
    }


    public function restoreSlate($id) {
                  
        $slate = Slate::withTrashed()->find($id);
        $slate->restore();

        $this->restoreAsignacionesSlate($slate); 
        $this->restoreValoracionesSlate($slate);       

       return redirect()->back()->with('info', 'Slate recuperado :)');
    }


    public function restoreInscripcionesUser($user) {
                  
        $user->inscripciones()->withTrashed()->get()
                ->each(function($inscripcion) {
                    $inscripcion->restore();
                    $this->restoreAsignacionesInscripcion($inscripcion); 
                    $this->restoreValoracionesInscripcion($inscripcion);  
                });
    }


    public function restoreSlateUser($user) {
                  
        $user->slate()->withTrashed()->get()
                ->each(function($slate) {
                    $slate->restore();
                    $this->restoreAsignacionesSlate($slate); 
                    $this->restoreValoracionesSlate($slate);  
                });
    }


    public function restoreAsignacionesUser($user) {

        $user->asignaciones()->withTrashed()->get()
                ->each(function($asignacion) {
                    $asignacion->restore();
                });
    }


    public function restoreValoracionesUser($user) {

        $user->valoraciones()->withTrashed()->get()
                ->each(function($valoracion) {
                    $valoracion->restore();
                });
    }


    public function restoreAsignacionesInscripcion($inscripcion) {

        $inscripcion->asignaciones()->withTrashed()->get()
                ->each(function($asignacion) {
                    $asignacion->restore();
                });
    }


    public function restoreValoracionesInscripcion($inscripcion) {

        $inscripcion->valoraciones()->withTrashed()->get()
                ->each(function($valoracion) {
                    $valoracion->restore();
                });
    }


    public function restoreAsignacionesSlate($slate) {

        $slate->asignaciones()->withTrashed()->get()
                ->each(function($asignacion) {
                    $asignacion->restore();
                });
    }


    public function restoreValoracionesSlate($slate) {

        $slate->valoracionesSlate()->withTrashed()->get()
                ->each(function($valoracion) {
                    $valoracion->restore();
                });
    }
}
