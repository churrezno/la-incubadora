<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slate extends Model
{
    
    use HasFactory;
    use SoftDeletes;

    protected $table = 'slates';

    protected $guarded = [];


    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function asignaciones() {

        return $this->hasMany('App\Models\Asignacion');
    }

    public function valoraciones() {

        return $this->hasManyThrough('App\Models\Valoracion', 'App\Models\Asignacion');
    }

    public function categoria() {

        return $this->belongsTo('App\Models\Categoria');
    }


    public function puntuacion_total() {

        $valoraciones = $this->valoraciones;
        $puntos_total = 0;
        $numero_valoraciones = 0;
        
        foreach ($valoraciones as $valoracion) {
            $puntos_total += $valoracion->puntos_total;
            $numero_valoraciones++;
        }

        if ( $numero_valoraciones != 0 )
            return round( $puntos_total / $numero_valoraciones, 1 );
        else
            return '-';

    }

    public function checkComite($comiteId, $asignaciones) {

        return ($asignaciones->contains('user_id', $comiteId)) ?? true;
    }
}
