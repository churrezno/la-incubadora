<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'asignaciones';

    protected $guarded = [];


    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function inscripcion() {

        return $this->belongsTo('App\Models\Inscripcion');
    }

    public function asignable() {

        return $this->morphTo();
    }

    public function valoracion() {

        return $this->hasOne('App\Models\Valoracion');
    }

    public function valoracionSlate() {

        return $this->hasOne('App\Models\ValoracionSlate');
    }
}
