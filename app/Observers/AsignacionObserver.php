<?php

namespace App\Observers;

use App\Models\Asignacion;

class AsignacionObserver
{
    /**
     * Handle the Asignación "deleted" event.
     */
    public function deleting(Asignacion $asignacion): void
    {
        if($asignacion->valoracion) {
            $asignacion->valoracion->delete();
        }
    }
}
