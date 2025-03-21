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
        Schema::create('desarrollo_cria', function (Blueprint $table) {
            $table->id();
            $table->string('vigor_colmena');
            $table->string('actividad_abejas');
            $table->string('ingreso_polen');
            $table->string('bloqueo_camara_cria');
            $table->string('presencia_celdas_reales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desarrollo_cria');
    }
};
