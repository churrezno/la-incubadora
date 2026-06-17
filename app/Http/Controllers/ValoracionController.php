<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use App\Http\Requests\StoreValoracionRequest;
use App\Http\Requests\StoreValoracionSlateRequest;
use App\Models\Asignacion;
use App\Models\Valoracion;
use App\Models\ValoracionSlate;

class ValoracionController extends Controller
{
    public function index()
    {

        $heads = [
            ['label' => 'Fecha'],
            ['label' => 'Comité'],
            ['label' => 'Título', 'width' => 20],
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


    public function storeSlate(StoreValoracionSlateRequest $request, Asignacion $asignacion)
    {
        try
        {
            $existing = $asignacion->valoracionSlate;
            
            if ($existing) {
                $existing->update($request->only(['comentarios', 'puntos']));
            } else {
                ValoracionSlate::create([
                    'asignacion_id' => $asignacion->id,
                    'comentarios' => $request->comentarios,
                    'puntos' => $request->puntos,
                ]);
            }
            
            return redirect()->back()->with('info', 'Valoración guardada correctamente :)');

        }   
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Error al guardar la valoración: ' . $e->getMessage())->withInput();
        }

    }
}
