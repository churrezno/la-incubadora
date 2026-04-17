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
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();

            $table->text('guion');
            $table->float('puntos_guion', 3, 1);
            $table->text('financiacion');
            $table->float('puntos_financiacion', 3, 1);
            $table->text('solicitante');
            $table->float('puntos_solicitante', 3, 1);
            $table->float('puntos_total', 3, 1);

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
        Schema::dropIfExists('valoraciones');
    }
};
