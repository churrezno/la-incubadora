<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    
    use HasFactory;
    use SoftDeletes;

    protected $table = 'inscripciones';

    protected $guarded = [];


    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function asignaciones() {

        return $this->morphMany(Asignacion::class, 'asignable');
    }

    public function valoraciones()
    {
        return Valoracion::whereHas('asignacion', function ($query) {
            $query->where('asignable_type', 'App\Models\Inscripcion')
                  ->where('asignable_id', $this->id);
        });
    }

    public function getValoracionesAttribute()
    {
        return $this->valoraciones()->get();
    }

    public function categoria() {

        return $this->belongsTo('App\Models\Categoria');
    }

    public function archivos()
    {
        return $this->morphMany(Archivo::class, 'archivable');
    }

    public function archivo_tipo() {

        return $this->belongsToMany('App\Models\Archivo_tipo', 'archivos');
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
