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
        Schema::create('estado_nutricional', function (Blueprint $table) {
            $table->id();
            $table->string('reserva_miel_polen');
            $table->string('tipo_alimentacion');
            $table->string('fecha_aplicacion');
            $table->string('insumo_utilizado');
            $table->string('dosifiacion');
            $table->string('metodo_utilizado');
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
