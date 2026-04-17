<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Valoracion extends Model
{
    use HasFactory;
    use BelongsToThrough;
    use SoftDeletes;

    protected $table = 'valoraciones';

    protected $guarded = [];
    

    public function user() {
        
        return $this->belongsToThrough(
                            'App\Models\User',
                            'App\Models\Asignacion',
                            foreignKeyLookup: ['App\Models\Asignacion' => 'asignacion_id']
        );
    }

    public function inscripcion() {
        
        return $this->belongsTo('App\Models\Inscripcion');
    }

    public function asignacion() {
        
        return $this->belongsTo('App\Models\Asignacion');
    }
}
