<?php

namespace App\Observers;

use App\Models\Inscripcion;
use Illuminate\Support\Facades\Storage;

class InscripcionObserver
{
    /**
     * Handle the Inscripcion "created" event.
     */
    public function created(Inscripcion $inscripcion): void
    {
        //
    }

    /**
     * Handle the Inscripcion "deleted" event.
     */
    public function deleting(Inscripcion $inscripcion): void
    {
        /* if($inscripcion->archivos->count() > 0) {
            Storage::delete($inscripcion->archivos[0]->url);
        } */

        if($inscripcion->valoraciones->count() > 0) {
            foreach ($inscripcion->valoraciones as $valoracion) {
                $valoracion->delete();
            }
        }

        if($inscripcion->asignaciones->count() > 0) {
            foreach ($inscripcion->asignaciones as $asignacion) {
                $asignacion->delete();
            }
        }
    }
}
