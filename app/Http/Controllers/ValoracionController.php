<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use App\Http\Requests\StoreValoracionRequest;
use App\Models\Asignacion;
use App\Models\Valoracion;

class ValoracionController extends Controller
{
    public function index()
    {

        $heads = [
            ['label' => 'Fecha', 'width' => 10],
            //'Asignacion ID',
            //'Asignacion',
            ['label' => 'Comité', 'width' => 10],
            ['label' => 'Título', 'width' => 15],
            'Valoración',
        ];

        $config = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json')
            ],
            'ajax' => [
                'url' => route('datatable.all-valoraciones')
            ],
            'columns' => [
                ['data' => 'fecha'],
                //['data' => 'asignacion_id'],
                //['data' => 'asignacion'],
                ['data' => 'comite', 'width' => '100px'],
                ['data' => 'titulo', 'class' => 'titulo'],
                ['data' => 'valoracion'],
            ],
            'pageLength' => 10,
            'lengthMenu' => [[ 10, 25, 50, 75, 100, -1 ],[ 10, 25, 50, 75, 100, "Todas" ]],
            'buttons' => [
                ['pageLength'],
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF'],
            ],
            'order' =>  [
                [2, 'desc']
            ],
            'layout' => [
                'topStart' => 'buttons'
            ] 
        ];

        return view('valoraciones.index', compact('heads', 'config'));
    }
    

    
    public function store(StoreValoracionRequest $request, Asignacion $asignacion)
    {
        $editRequest = $request->merge(['asignacion_id' => $asignacion->id]);
        $idValoracion = $asignacion->valoracion?->id;
                
        try
        {
            if ( $idValoracion == null )
            {
                $valoracion = Valoracion::create($editRequest->all());
                return redirect()->back()->with('info', 'Valoración creada correctamente :)');
            }
            else
            {
                $valoracion = Valoracion::find($idValoracion);
                $valoracion->update($request->except('asignacion_id'));
                return redirect()->back()->with('info', 'Valoración actualizada correctamente :)');
            }



        }   

        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1062){
                return redirect()->back()->with('info', 'Ooooooops!! Entrada ya existente :(');
            }
        }

    }
}
