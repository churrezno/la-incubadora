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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();

            // Paso 1
            $table->string('titulo');
            $table->string('director');
            $table->date('fecha_nac_director');
            $table->string('sexo_director', 50);
            $table->boolean('switch_largometrajes')->default(false);
            $table->string('largometrajes')->nullable();
            $table->boolean('switch_codirector')->default(false);
            $table->string('codirector')->nullable();
            $table->boolean('switch_guionista')->default(false);
            $table->string('guionista')->nullable();
            $table->boolean('switch_coguionista')->default(false);
            $table->string('coguionista')->nullable();

            // Paso 2
            $table->string('productora', 255)->nullable();
            $table->string('tel_productor')->nullable();
            $table->string('cod_postal_productor')->nullable();
            $table->string('ciudad_productor', 255)->nullable();
            $table->string('pais_productor', 255)->nullable();
            $table->string('email_productor', 80)->nullable();
            $table->string('web_productor', 255)->nullable();
            $table->string('productor')->nullable();
            $table->date('fecha_nac_productor')->nullable();
            $table->string('sexo_productor', 50)->nullable();
            $table->boolean('switch_coproductor')->default(false);
            $table->string('coproductor')->nullable();
            $table->boolean('switch_paises_coproduccion')->default(false);
            $table->string('paises_coproduccion')->nullable();

            // Paso 3
            $table->text('biofilmografia_director')->nullable();
            $table->text('titulo_1')->nullable();
            $table->string('link_1', 255)->nullable();
            $table->string('password_1', 45)->nullable();
            $table->text('titulo_2')->nullable();
            $table->string('link_2', 255)->nullable();
            $table->string('password_2', 45)->nullable();
            $table->text('titulo_3')->nullable();
            $table->string('link_3', 255)->nullable();
            $table->string('password_3', 45)->nullable();
            $table->text('nota_director')->nullable();
            $table->text('biofilmografia_productora')->nullable();
            $table->text('nota_productor')->nullable();
            $table->text('biofilmografia_guionista')->nullable();
            $table->string('idioma', 255)->nullable();
            $table->integer('duracion')->nullable();
            $table->string('genero', 50)->nullable();
            $table->text('logline')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('presupuesto', 45)->nullable();
            $table->text('plan_financiacion')->nullable();
            $table->text('plan_promocion')->nullable();
            $table->boolean('switch_otros_programas')->default(false);
            $table->text('otros_programas')->nullable();
            $table->boolean('switch_otras_incubadora')->default(false);
            $table->text('status')->nullable();
            $table->text('otros_proyectos')->nullable();
            $table->text('motivaciones')->nullable();
            $table->text('conocido')->nullable();
            $table->boolean('switch_acepta_bases')->default(false);
            $table->boolean('switch_acepta_politica')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categoria_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->boolean('complete')->default(false);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
