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
        Schema::create('presencia_varroa', function (Blueprint $table) {
            $table->id();
            $table->string('diagnostico_visual');
            $table->string('muestreo_abejas_adultas');
            $table->string('muestreo_cria_operculada');
            $table->string('tratamiento');
            $table->string('fecha_aplicacion');
            $table->string('dosificacion');
            $table->string('metodo_aplicacion');
            $table->string('n_colmenas_tratadas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
