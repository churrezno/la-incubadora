<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValoracionSlate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'valoraciones_slate';
    protected $guarded = [];
    

    public function user() {
        
        return $this->belongsToThrough(
                            'App\Models\User',
                            'App\Models\Asignacion',
                            foreignKeyLookup: ['App\Models\Asignacion' => 'asignacion_id']
        );
    }

    public function slate() {
        
        return $this->belongsTo('App\Models\Slate');
    }

    public function asignacion() {
        
        return $this->belongsTo('App\Models\Asignacion');
    }
}