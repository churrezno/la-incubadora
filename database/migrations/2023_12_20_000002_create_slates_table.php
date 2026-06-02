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
        Schema::create('slates', function (Blueprint $table) {
            $table->id();

            $table->string('productor')->nullable();
            $table->date('fecha_nac_productor')->nullable();
            $table->string('sexo_productor', 50)->nullable();
            $table->string('productora', 255)->nullable();
            $table->string('tel_productor')->nullable();
            $table->string('cod_postal_productor')->nullable();
            $table->string('ciudad_productor', 255)->nullable();
            $table->string('pais_productor', 255)->nullable();
            $table->string('email_productor', 80)->nullable();
            $table->string('web_productor', 255)->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categoria_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slates');
    }
};
