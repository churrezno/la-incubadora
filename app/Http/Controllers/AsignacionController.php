<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;

class AsignacionController extends Controller
{
    public function manage(Request $request){

        
        $idInscripcion = $request->id_inscripcion;
        $idsRequest = [];

        $idsAsignaciones = Asignacion::where('inscripcion_id', $idInscripcion)
                                    ->get()
                                    ->pluck('user_id')
                                    ->toArray();

        // Create new asignaciones from request when not existing
        foreach($request->all() as $key => $value) {
  
            if( str_contains($key, 'user')) {

                $idsRequest[] = $value;
                
                if (!in_array($value, $idsAsignaciones))  {
               
                    Asignacion::create([
                        'user_id' => $value,
                        'inscripcion_id' => $idInscripcion
                    ]);                
                }
            }
        }

        // Delete asignaciones if not present in request
        $diff = collect($idsAsignaciones)->diff(collect($idsRequest));
        
        foreach($diff as $idBorrar) {
            $asignacionBorrar = Asignacion::where('user_id', ($idBorrar))
                                        ->where('inscripcion_id', $idInscripcion)
                                        ->first();

            $asignacionBorrar->delete();
        }
        
        return redirect()->route('inscripciones.index')->with('info', 'Inscripción reasignada correctamente :)');
    }
}
