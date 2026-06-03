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
        Schema::table('valoraciones_slate', function (Blueprint $table) {
            $table->dropColumn('puntos_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valoraciones_slate', function (Blueprint $table) {
            $table->unsignedTinyInteger('puntos_total')->after('puntos');
        });
    }
};
