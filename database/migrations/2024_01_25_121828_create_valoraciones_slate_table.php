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
        Schema::create('valoraciones_slate', function (Blueprint $table) {
            $table->id();

            $table->text('comentarios');
            $table->float('puntos', 3, 1);

            $table->unsignedBigInteger('asignacion_id')->unique();

            $table->foreign('asignacion_id')->references('id')->on('asignaciones')->onDelete('cascade');

            $table->timestamps();
            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoraciones_slate');
    }
};
