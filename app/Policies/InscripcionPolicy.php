<?php

namespace App\Policies;

use App\Models\Inscripcion;
use App\Models\User;

class InscripcionPolicy
{
    
    public function view(User $user, Inscripcion $inscripcion)
    {
        $asignaciones = $inscripcion->asignaciones;
        $inscripcionAsignada = false;

        foreach ( $asignaciones as $asignacion ) {
            if ( $asignacion->user_id == $user->id ) {
                $inscripcionAsignada = true;
                break;
            }
        }

        return ( $user->hasRole('admin') || $inscripcionAsignada == true || ($user->id == $inscripcion->user_id) ) ?
            true :
            false;
    }
}
