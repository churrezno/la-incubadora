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

        return $this->morphMany(Asignacion::class, 'asignable');
    }

    public function valoracionesSlate()
    {
        return ValoracionSlate::whereHas('asignacion', function ($query) {
            $query->where('asignable_type', 'App\Models\Slate')
                  ->where('asignable_id', $this->id);
        });
    }

    public function getValoracionesSlateAttribute()
    {
        return $this->valoracionesSlate()->get();
    }

    public function categoria() {

        return $this->belongsTo('App\Models\Categoria');
    }

    public function archivo()
    {
        return $this->morphOne(Archivo::class, 'archivable');
    }



    public function puntuacion_total() {

        $valoraciones = $this->valoracionesSlate;
        if ($valoraciones->isEmpty()) {
            return '-';
        }

        $puntos_total = $valoraciones->sum('puntos');
        $numero_valoraciones = $valoraciones->count();

        return round($puntos_total / $numero_valoraciones, 1);
    }

    public function checkComite($comiteId, $asignaciones) {

        return ($asignaciones->contains('user_id', $comiteId)) ?? true;
    }
}
