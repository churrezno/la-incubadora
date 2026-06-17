<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('url', 120);
            $table->unsignedBigInteger('archivo_tipo_id');
            $table->morphs('archivable');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('archivo_tipo_id')->references('id')->on('archivo_tipos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};