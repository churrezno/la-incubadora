<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archivo_tipo extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function archivo() {

        return $this->hasOne('App\Models\Archivo');
    }
}
