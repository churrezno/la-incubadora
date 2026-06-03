<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use App\Models\Slate;
use App\Models\Inscripcion;

class AsignacionController extends Controller
{
    public function manage(Request $request)
    {
        $idSlate = $request->id_slate;
        $idInscripcion = $request->id_inscripcion;
        $idsRequest = [];

        if ($idSlate) {
            $idsAsignaciones = Asignacion::where('asignable_type', Slate::class)
                                        ->where('asignable_id', $idSlate)
                                        ->get()
                                        ->pluck('user_id')
                                        ->toArray();

            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'user')) {
                    $idsRequest[] = $value;

                    if (!in_array($value, $idsAsignaciones)) {
                        Asignacion::create([
                            'user_id' => $value,
                            'asignable_id' => $idSlate,
                            'asignable_type' => Slate::class,
                        ]);
                    }
                }
            }

            $diff = collect($idsAsignaciones)->diff(collect($idsRequest));

            foreach ($diff as $idBorrar) {
                $asignacionBorrar = Asignacion::where('user_id', $idBorrar)
                                            ->where('asignable_type', Slate::class)
                                            ->where('asignable_id', $idSlate)
                                            ->first();

                if ($asignacionBorrar) {
                    $asignacionBorrar->delete();
                }
            }

            return redirect()->route('slates.index')->with('info', 'Asignaciones actualizadas correctamente :)');

        } else {
            $idsAsignaciones = Asignacion::where('asignable_type', Inscripcion::class)
                                        ->where('asignable_id', $idInscripcion)
                                        ->get()
                                        ->pluck('user_id')
                                        ->toArray();

            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'user')) {
                    $idsRequest[] = $value;

                    if (!in_array($value, $idsAsignaciones)) {
                        Asignacion::create([
                            'user_id' => $value,
                            'asignable_id' => $idInscripcion,
                            'asignable_type' => Inscripcion::class,
                        ]);
                    }
                }
            }

            $diff = collect($idsAsignaciones)->diff(collect($idsRequest));

            foreach ($diff as $idBorrar) {
                $asignacionBorrar = Asignacion::where('user_id', $idBorrar)
                                            ->where('asignable_type', Inscripcion::class)
                                            ->where('asignable_id', $idInscripcion)
                                            ->first();

                if ($asignacionBorrar) {
                    $asignacionBorrar->delete();
                }
            }

            return redirect()->route('inscripciones.index')->with('info', 'Inscripción reasignada correctamente :)');
        }
    }
}