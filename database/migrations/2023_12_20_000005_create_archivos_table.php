<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();

            $table->string('url', 120);

            $table->unsignedBigInteger('inscripcion_id');
            $table->unsignedBigInteger('archivo_tipo_id');

            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onDelete('cascade');
            $table->foreign('archivo_tipo_id')->references('id')->on('archivo_tipos')->onDelete('cascade');

            $table->timestamps();
            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
