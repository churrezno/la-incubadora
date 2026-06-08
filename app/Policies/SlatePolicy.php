<?php

namespace App\Policies;

use App\Models\Slate;
use App\Models\User;

class SlatePolicy
{
    
    public function view(User $user, Slate $slate)
    {
        $asignaciones = $slate->asignaciones;
        $slateAsignada = false;

        foreach ( $asignaciones as $asignacion ) {
            if ( $asignacion->user_id == $user->id ) {
                $slateAsignada = true;
                break;
            }
        }

        return ( $user->hasRole('admin') || $slateAsignada == true || ($user->id == $slate->user_id) ) ?
            true :
            false;
    }

    public function update(User $user, Slate $slate)
    {
        return $user->hasRole('admin');
    }
}