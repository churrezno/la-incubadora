<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archivo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function archivable()
    {
        return $this->morphTo();
    }

    public function archivo_tipo() {

        return $this->belongsTo('App\Models\Archivo_tipo');
    }
}
