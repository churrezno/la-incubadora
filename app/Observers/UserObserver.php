<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    /**
     * Handle the User "deleted" event.
     */
    public function deleting(User $user): void
    {

        if ($user->inscripciones) {
            foreach ($user->inscripciones as $inscripcion) {
                $inscripcion->delete();
            }
        }

        if ($user->asignaciones) {
            foreach ($user->asignaciones as $asignacion) {
                $asignacion->delete();
            }
        }
    }

    public function created(User $user)
    {
        $roleExists = Role::query()
            ->where('name', 'solicitante')
            ->where('guard_name', 'web')
            ->exists();

        if ($roleExists && ! $user->hasRole('admin')) {
            $user->assignRole('solicitante');
        }
    }
}
